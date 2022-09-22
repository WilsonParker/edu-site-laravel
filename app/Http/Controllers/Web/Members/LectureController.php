<?php

namespace App\Http\Controllers\Web\Members;

use App\Events\LecturePlayEvent;
use App\Exceptions\Lectures\NotValidLectureException;
use App\Http\Controllers\Web\BaseController;
use App\Http\Middleware\RedirectNeedOTP;
use App\Http\Middleware\ValidateLectureProgramEndTime;
use App\Http\Requests\Web\Members\LectureRequest;
use App\Models\Lectures\LectureClassesModel;
use App\Models\Lectures\MemberLectureProgressRateHistoriesModel;
use App\Models\Lectures\MemberLectureProgressRecordsModel;
use App\Models\Members\MemberLectureClassesModel;
use App\Models\Members\MemberLectureProgramModel;
use App\Services\Auth\AuthService;
use App\Services\Lectures\LectureService;
use App\ViewModels\Web\Members\LectureViewModel;
use Illuminate\Http\Request;
use LaravelSupports\Libraries\Supports\Http\Responses\ResponseDefaultConfigTemplate;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class LectureController extends BaseController
{
    protected array $prefix = ['members', 'lectures'];

    protected function init()
    {
        $this->middleware('auth:web');
        $this->middleware([ValidateLectureProgramEndTime::class])->only(['detail']);
        $this->middleware([ValidateLectureProgramEndTime::class, RedirectNeedOTP::class])->only(['play']);
        $this->viewModel = new LectureViewModel();
        $this->viewModel->setIp(request());
    }

    public function learning()
    {
        $member = AuthService::getAuthMember();
        $member->load(['availableMemberLecturePrograms.lectureProgram.lecture.exams', 'availableMemberLecturePrograms.lectureProgram.lecture.classes']);
        $service = new LectureService($member);

        $data = $member->availableMemberLecturePrograms->map(function ($item) use ($service) {
            $item->rate = $service->getProgramTotalProgressRate($item);
            return $item;
        });
        $this->viewModel->page = 1;
        $this->viewModel->data = $data;
        $this->viewModel->member = $member;
        $this->viewModel->menuTitle = '학습중인 수업';
        return $this->buildView('learning');
    }

    public function ended()
    {
        $member = AuthService::getAuthMember();
        $member->load('endedLecturePrograms.lecture');
        $this->viewModel->page = 2;
        $this->viewModel->data = $member->endedLecturePrograms;
        $this->viewModel->member = $member;
        $this->viewModel->menuTitle = '학습종료된 수업';
        return $this->buildView('ended');
    }

    public function detail(Request $request, MemberLectureProgramModel $lecture)
    {
        $member = AuthService::getAuthMember();
        if ($member->availableMemberLecturePrograms->exists($lecture)) {
            $lecture->load(['lectureProgram.lecture.classes', 'lectureProgram.lecture.exams', 'memberExams']);
            $service = new LectureService($member);
            $histories = MemberLectureProgressRateHistoriesModel::getHistories($member, $lecture);
            $rates = $histories->groupBy('lecture_class_idx')
                ->map(function ($histories) use ($service) {
                    return [
                        'rate' => $service->getProgressRate($histories),
                        'totalTime' => $service->sumProgressTime($histories),
                    ];
                })->toArray();
            $lecture->lectureProgram->lecture->classes->map(function ($class) use ($rates) {
                $class->rate = $rates[$class->idx]['rate'] ?? 0;
                $class->totalTime = $rates[$class->idx]['totalTime'] ?? 0;
                return $class;
            });
            $lecture->lectureProgram->rate = $service->getHistoriesTotalProgressRate($histories, $lecture);

            $this->viewModel->page = 1;
            $this->viewModel->data = $lecture;
            $this->viewModel->member = $member;
            $this->viewModel->menuTitle = '내강의실';
            $this->viewModel->setMemberLectureProgramModel($lecture);
            return $this->buildView('detail');
        } else {
            return redirect(route('members.lectures.learning'))->with([
                'message' => '수강할 수 없는 강의 입니다.'
            ]);
        }
    }

    public function beforePlay(Request $request, MemberLectureProgramModel $program, LectureClassesModel $class)
    {
        $callback = function () use ($request, $program, $class, &$validProgram) {
            if ($class->number % 8 == 1) {
                $member = AuthService::getAuthMember();
                MemberLectureClassesModel::firstOrCreate([
                    'member_idx' => $member->idx,
                    'member_lecture_program_idx' => $program->idx,
                    'lecture_class_idx' => $class->idx,
                ]);
            }
            return redirect()->to(route('members.lectures.play', ['program' => $program, 'class' => $class]));
        };
        $errorCallback = function (\Throwable $throwable) use ($program) {
            return redirect(route('members.lectures.detail', $program))->with([
                'message' => $throwable->getMessage()
            ]);
        };
        return $this->runTransaction($callback, $errorCallback);
    }

    public function play(Request $request, MemberLectureProgramModel $program, LectureClassesModel $class)
    {
        $validProgram = null;
        $callback = function () use ($request, $program, $class, &$validProgram) {
            $member = AuthService::getAuthMember();
            $member->load(['availableMemberLecturePrograms.lectureProgram.lecture.classes']);

            // 수강 가능한 강의 인지 확인
            $programs = $member->availableMemberLecturePrograms->pluck('lectureProgram')->flatten();
            throw_unless($programs->exists($program->lectureProgram), new NotValidLectureException());
            $classes = $programs->map(fn($item) => $item->lecture->classes)->flatten();
            throw_unless($classes->flatten()->exists($class), new NotValidLectureException());

            $validProgram = $member->availableMemberLecturePrograms->first(function ($item) use ($program) {
                return $item->lecture_program_idx == $program->lectureProgram->idx;
            });

            /**
             * @todo
             * 1일 수강 제한 체크
             * @author  dev9163
             * @added   2021/11/18
             * @updated 2021/11/18
             */
            $history = MemberLectureProgressRateHistoriesModel::createModel($program, $class, $member);
            $service = new LectureService($member);
            if ($service->isPlayable($history)) {
                $history->class = $class;
                $history->program = $program;
                $this->viewModel->data = $history;
                $this->viewModel->member = $member;
                return $this->buildView('play');
            }
        };
        $errorCallback = function (\Throwable $throwable) use (&$validProgram) {
            if (isset($validProgram)) {
                return redirect(route('members.lectures.detail', $validProgram))->with([
                    'message' => $throwable->getMessage()
                ]);
            } else {
                return redirect(route('members.lectures.learning'))->with([
                    'message' => $throwable->getMessage()
                ]);
                // return new Abort('수강할 수 없는 강의 입니다.', ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
            }
        };
        return $this->runTransaction($callback, $errorCallback);
    }

    public function playing(LectureRequest $request, MemberLectureProgressRateHistoriesModel $history)
    {
        $validated = $request->validated();
        $member = AuthService::getAuthMember();
        $query = MemberLectureProgressRecordsModel::where('member_idx', $member->idx)->where('member_lecture_program_idx', $history->member_lecture_program_idx)->where('lecture_class_idx', $history->lecture_class_idx);
        if ($query->exists()) {
            $record = $query->first();
            $record->end_page = $validated['number'];
            $record->time = $validated['time'];
            $record->save();
        } else {
            MemberLectureProgressRecordsModel::create([
                'member_idx' => $member->idx,
                'member_lecture_program_idx' => $history->member_lecture_program_idx,
                'lecture_class_idx' => $history->lecture_class_idx,
                'end_page' => $validated['number'],
                'time' => $validated['time'],
            ]);
        }

        event(new LecturePlayEvent($history, now()));
        return new ResponseDefaultConfigTemplate(ResponseAlias::HTTP_OK, 'api.lecture.playing');
    }
}
