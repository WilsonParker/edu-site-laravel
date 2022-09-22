<?php

namespace App\Http\Controllers\Web\Lectures;

use App\Exceptions\Lectures\Exams\AlreadySubmitExamException;
use App\Exceptions\Lectures\Exams\EndOfExamException;
use App\Exceptions\Lectures\Exams\ExamException;
use App\Exceptions\Lectures\Exams\NotFoundExamException;
use App\Http\Controllers\Web\BaseController;
use App\Http\Middleware\LectureEvaluable;
use App\Http\Middleware\RedirectNeedOTP;
use App\Http\Middleware\ValidateLectureProgramEndTime;
use App\Http\Requests\Web\Lectures\ExamRequest;
use App\Models\Lectures\ExamKind;
use App\Models\Lectures\ExamStatus;
use App\Models\Lectures\ExamType;
use App\Models\Lectures\LectureExamSubmitsModel;
use App\Models\Members\MemberExamsModel;
use App\Models\Members\MemberLectureProgramModel;
use App\Models\Members\MembersModel;
use App\Services\Auth\AuthService;
use App\Services\Lectures\LectureService;
use App\ViewModels\Web\Lectures\ExamViewModel;
use Illuminate\Http\Request;
use LaravelSupports\Libraries\Supports\Http\Responses\ResponseDefaultConfigTemplate;
use LaravelSupports\Libraries\Supports\Http\Responses\ResponseErrorTemplate;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Throwable;

/**
 * @todo
 * OTP 확인 필요
 *
 * @author  dev9163
 * @added   2021/12/27
 * @updated 2021/12/27
 */
class ExamController extends BaseController
{
    protected array $prefix = ['lectures.exams'];

    protected function init()
    {
        $this->middleware(['auth:web', LectureEvaluable::class]);
        $this->middleware([RedirectNeedOTP::class, ValidateLectureProgramEndTime::class])->only(['exam', 'examSubmit']);
    }

    /**
     * 시험 전 약관 동의 페이지
     *
     * @param Request $request
     * @param string $type
     * @param MemberLectureProgramModel $program
     * @author  dev9163
     * @added   2021/12/30
     * @updated 2021/12/30
     */
    public function agree(Request $request, string $type, MemberLectureProgramModel $program)
    {
        $member = AuthService::getAuthMember();
        $callback = function () use ($member, $program, $type) {
            $query = $this->getMemberExamModelQuery($type, $member, $program);
            if ($query->exists() && $query->firstOrFail()->agree) {
                return redirect()->to(route("lectures.exams.exam", ['type' => $type, 'program' => $program]));
            } else {
                $this->viewModel = new ExamViewModel($program);
                return $this->buildView("{$type}_agree");
            }
        };
        $errorCallback = function (Throwable $throwable) use ($member, $program, $type) {
            $route = route('members.lectures.detail', $this->getMemberLectureProgramModelQuery($member, $program)->firstOrFail());
            return $this->redirectUrlWithMessage($throwable->getMessage(), $route);
        };
        return $this->runTransaction($callback, $errorCallback);
    }

    /**
     * 시험 전 약관 동의 처리
     *
     * @param Request $request
     * @param string $type
     * @param MemberLectureProgramModel $program
     * @author  dev9163
     * @added   2021/12/30
     * @updated 2021/12/30
     */
    public function agreeSubmit(Request $request, string $type, MemberLectureProgramModel $program)
    {
        $member = AuthService::getAuthMember();
        $callback = function () use ($program, $member, $request, $type) {
            if (!$this->getMemberExamModelQuery($type, $member, $program)->exists()) {
                $params = [
                    // 'member_idx' => $member->idx,
                    'member_lecture_program_idx' => $program->idx,
                    'exam_type_code' => $type,
                    'exam_status_code' => ExamStatus::NONE,
                    'agree' => true,
                    'ip' => $request->ip(),
                    'start' => now(),
                ];

                $memberExamModel = MemberExamsModel::create($params);

                $sort = 1;
                $filterAndRandom = function ($collection, ExamType|array $type, int $random, &$sort, $program) use ($memberExamModel) {
                    return $collection->filter(function ($exam) use ($type) {
                        if ($type instanceof ExamType) {
                            return $exam->exam_type == $type->value;
                        } else {
                            return collect($type)->reduce(function ($carry, $item) use ($exam) {
                                return $carry || ($exam->exam_type == $item->value);
                            }, false);
                        }
                    })->pipe(function ($exams) use ($type, $random, &$sort, $program, $memberExamModel) {
                        $count = $exams->count() >= $random ? $random : $exams->count();
                        $exams->random($count)
                            ->each(function ($exam) use (&$sort, $program, $memberExamModel) {
                                LectureExamSubmitsModel::createModel($memberExamModel, $exam, $sort++);
                            });
                    });
                };
                switch ($type) {
                    case ExamKind::MIDDLE->value:
                        $filterAndRandom($program->lectureProgram->lecture->middleExams, [ExamType::MULTIPLE, ExamType::AUTHENTIC], $program->lectureProgram->lecture->information->mid_multiple_choice_count, $sort, $program);
                        break;
                    case ExamKind::FINAL->value:
                        $filterAndRandom($program->lectureProgram->lecture->finalExams, [ExamType::MULTIPLE, ExamType::AUTHENTIC], $program->lectureProgram->lecture->information->final_multiple_choice_count, $sort, $program);
                        $filterAndRandom($program->lectureProgram->lecture->finalExams, ExamType::SHORT, $program->lectureProgram->lecture->information->final_short_answer_count, $sort, $program);
                        $filterAndRandom($program->lectureProgram->lecture->finalExams, ExamType::SUBJECTIVE, $program->lectureProgram->lecture->information->final_narrative_count, $sort, $program);
                        break;
                    case ExamKind::TASK->value:
                        $filterAndRandom($program->lectureProgram->lecture->taskExams, [ExamType::MULTIPLE, ExamType::AUTHENTIC, ExamType::SUBJECTIVE, ExamType::SHORT], 1, $sort, $program);
                        break;
                    default:
                        throw new NotFoundExamException();
                }
            }
            return $this->agree($request, $type, $program);
        };
        $errorCallback = function (Throwable $throwable) use ($program, $member, $type) {
            $route = route('members.lectures.detail', $this->getMemberLectureProgramModelQuery($member, $program)->firstOrFail());
            return $this->redirectUrlWithMessage($throwable->getMessage(), $route);
        };
        return $this->runTransaction($callback, $errorCallback);
    }

    /**
     * 시험 페이지
     *
     * @param ExamRequest $request
     * @param MemberLectureProgramModel $program
     * @author  dev9163
     * @added   2021/12/30
     * @updated 2021/12/30
     */
    public function exam(ExamRequest $request, string $type, MemberLectureProgramModel $program)
    {
        if ($type == ExamKind::FINAL->value) {
            $exam = $program->getMemberLectureFinalExam();
            if (!isset($exam->end)) {
                $day = now()->addMinutes($program->lectureProgram->lecture->information->final_exam_time);
                $exam->start = now();
                $exam->end = $day->greaterThan($program->learning_end_date) ? $program->learning_end_date : $day;
                $exam->save();
            }
        }

        $member = AuthService::getAuthMember();
        $validated = $request->validated();
        $page = $validated['page'] ?? 1;
        $query = $this->getLectureExamSubmitsQuery($type, $program);
        $count = $query->count();
        if ($query->exists()) {
            $model = $query->where('sort', $page)->firstOrFail();
            $this->viewModel = new ExamViewModel($model);
            $this->viewModel->exam = $this->getMemberExamModelQuery($type, $member, $program)->firstOrFail();
            $this->viewModel->examCount = $count;
            $this->viewModel->member = $member;
            $this->viewModel->program = $program;
            $this->viewModel->type = $type;
            $this->viewModel->setIp($request);
            if ($type == ExamKind::TASK->value) {
                return $this->buildView('task');
            } else {
                return $this->buildView('exam');
            }
        } else {
            $route = route('members.lectures.detail', $this->getMemberLectureProgramModelQuery($member, $program)->firstOrFail());
            return $this->redirectUrlWithMessage('시험이 존재하지 않습니다. 관리자에게 문의해주세요', $route);
        }
    }

    /**
     * 시험 문제 답 제출
     *
     * @param ExamRequest $request
     * @param MemberLectureProgramModel $program
     * @author  dev9163
     * @added   2021/12/30
     * @updated 2021/12/30
     * @updated 2022/01/03
     * add upload file
     */
    public function examStore(ExamRequest $request, string $type, MemberLectureProgramModel $program)
    {
        $validated = $request->validated();
        $prefix = 'api.lecture.exam.store';
        $callback = function () use ($validated, $prefix, $program, $type) {
            $member = AuthService::getAuthMember();
            $memberExam = $this->getMemberExamModelQuery($type, $member, $program)->firstOrFail();
            throw_if(isset($memberExam->end) && ($memberExam->exam_status_code != ExamStatus::NONE->value || now()->greaterThan($memberExam->end)), new EndOfExamException());

            $exam = $this->getLectureExamSubmitsQuery($type, $program)->where('sort', $validated['page'])->firstOrFail();
            $exam->answer = $validated['answer'];
            if (isset($validated['file'])) {
                $exam->attachment_idx = $exam->saveResourceWithFile($validated['file'])->idx;
            }
            $exam->save();
            return new ResponseDefaultConfigTemplate(ResponseAlias::HTTP_OK, $prefix);
        };
        $errorCallback = function (Throwable $throwable) use ($prefix) {
            if ($throwable instanceof ExamException) {
                return new ResponseErrorTemplate($throwable);
            } else {
                return new ResponseDefaultConfigTemplate(ResponseAlias::HTTP_BAD_REQUEST, $prefix);
            }
        };
        return $this->runTransaction($callback, $errorCallback);
    }

    /**
     * 시험 제출
     *
     * @param ExamRequest $request
     * @param MemberLectureProgramModel $program
     * @author  dev9163
     * @added   2021/12/30
     * @updated 2021/12/30
     */
    public function examSubmit(Request $request, string $type, MemberLectureProgramModel $program)
    {
        $member = AuthService::getAuthMember();
        $callback = function () use ($request, $program, $type, $member) {
            $exam = $this->getMemberExamModelQuery($type, $member, $program)->with('lectureExamSubmits')->firstOrFail();

            throw_if($exam->isComplete(), new AlreadySubmitExamException());
            $service = new LectureService($member);
            $exam->end = now();
            $exam->exam_status_code = $type == ExamKind::TASK->value ? ExamStatus::WAITING : ExamStatus::COMPLETE;
            $exam->score = $service->getScore($type, $exam->lectureExamSubmits, $program);
            $exam->save();
            return $this->redirectRouteWithMessage('시험 제출 완료하였습니다.', 'members.lectures.detail', [$this->getMemberLectureProgramModelQuery($member, $program)->firstOrFail()]);
        };
        $errorCallback = function (Throwable $throwable) use ($request, $program, $type, $member) {
            return $this->backWithErrors($throwable);
        };
        return $this->runTransaction($callback, $errorCallback);
    }

    protected function getMemberLectureProgramModelQuery(MembersModel $member, MemberLectureProgramModel $program): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $member->memberLecturePrograms()->where('lecture_program_idx', $program->lectureProgram->idx);
    }

    protected function getMemberExamModelQuery(string $type, MembersModel $member, MemberLectureProgramModel $program): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $member->lectureExams()->where('exam_type_code', $type)->where('member_lecture_program_idx', $program->idx)->with('lectureExamSubmits');
    }

    protected function getLectureExamSubmitsQuery(string $type, MemberLectureProgramModel $program): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        return $program->lectureExamSubmits()->where('exam_type_code', $type);
    }
}
