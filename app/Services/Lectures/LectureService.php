<?php

namespace App\Services\Lectures;

use App\Exceptions\Lectures\Exams\NeedProgressException;
use App\Exceptions\Lectures\NeedPreviousProgressException;
use App\Models\Lectures\ExamKind;
use App\Models\Lectures\ExamType;
use App\Models\Lectures\LectureProgramModel;
use App\Models\Lectures\MemberLectureProgressRateHistoriesModel;
use App\Models\Members\MemberLectureProgramModel;
use App\Models\Members\MembersModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class LectureService
{

    public function __construct(protected MembersModel $member)
    {
    }

    public function provides(Collection|LectureProgramModel $model)
    {
        if ($this->model instanceof Collection) {
            $this->model->each(function ($item) {
                $this->createModel($item);
            });
        } else {
            $this->createModel($this->model);
        }
    }

    /**
     * 재생 가능한 class 인지 확인
     *
     * 2차시 이후 부터는 전 차시의 진도율이 100% 일 경우에 가능
     *
     * @param MemberLectureProgressRateHistoriesModel $model
     * @return  bool
     * @throws NeedPreviousProgressException
     * @author  dev9163
     * @added   2021/11/18
     * @updated 2021/11/18
     */
    public function isPlayable(MemberLectureProgressRateHistoriesModel $model): bool
    {
        if ($model->lectureClass->number > 1) {
            $previousRate = $this->getProgressRate($model->getPreviousHistory());
            if ($previousRate >= 100) {
                return true;
            } else {
                throw new NeedPreviousProgressException();
            }
        } else {
            return true;
        }
    }

    public function getProgressRate(Collection|MemberLectureProgressRateHistoriesModel $model): int
    {
        if ($model instanceof Model) {
            $classTime = $model->lectureClass->time;
        } else {
            $classTime = $model->count() > 0 ? $model->first()->lectureClass->time : 1;
        }
        $rate = $this->sumProgressTime($model) / ($classTime * 60) * 100;
        return $rate > 100 ? 100 : $rate;
    }

    public function sumProgressTime(Collection|MemberLectureProgressRateHistoriesModel $model): int
    {
        if ($model instanceof Model) {
            $collection = MemberLectureProgressRateHistoriesModel::where([
                'member_lecture_program_idx' => $model->member_lecture_program_idx,
                'lecture_class_idx' => $model->lectureClass->idx,
                // 'member_idx' => $model->member_idx,
            ])->whereNotNull('end')
                ->get();
        } else {
            $collection = $model;
        }
        return $collection->sum(function ($item) {
            return Carbon::createFromTimeString($item->end)->diffInSeconds(Carbon::createFromTimeString($item->start));
        });
    }

    /**
     * 강의의 전체 진도율을 제공합니다
     *
     * @param MemberLectureProgramModel $model
     * @return int
     * @author  dev9163
     * @added   2021/11/23
     * @updated 2021/11/23
     */
    public function getProgramTotalProgressRate(MemberLectureProgramModel $model): int
    {
        return $this->getHistoriesTotalProgressRate(MemberLectureProgressRateHistoriesModel::getHistories($model), $model);
    }

    /**
     * 강의의 내역의 전체 진도율을 제공합니다
     *
     * @param Collection                $histories
     * @param MemberLectureProgramModel $memberLectureProgram
     * @return int
     * @author  dev9163
     * @added   2021/11/23
     * @updated 2021/11/23
     */
    public function getHistoriesTotalProgressRate(Collection $histories, MemberLectureProgramModel $memberLectureProgram): int
    {
        $rate = $histories
            ->groupBy('lecture_class_idx')
            ->sum(function ($items) {
                return $this->getProgressRate($items);
            });
        return $this->getTotalProgressRate($rate, $memberLectureProgram);
    }

    /**
     * 시험 진행이 가능한지 여부 확인
     *
     * @param ExamKind                  $type
     * @param MemberLectureProgramModel $memberLectureProgramModel
     * @return bool
     * @throws \Throwable
     * @author  dev9163
     * @added   2021/12/27
     * @updated 2021/12/27
     */
    public function isEvaluable(ExamKind $type, MemberLectureProgramModel $memberLectureProgramModel): bool
    {
        switch ($type) {
            case ExamKind::MIDDLE:
                $number = $memberLectureProgramModel->getMiddleClassNumber();
                $histories = MemberLectureProgressRateHistoriesModel::getHistoriesWithNumber($memberLectureProgramModel, $number);
                $rate = $this->getProgressRate($histories);
                // 총 강의의 중간 강의를 수강 했는지 확인
                throw_if($rate < 100, new NeedProgressException("{$number}강 강의를 수강하셔야 합니다"));
                break;
            case ExamKind::FINAL:
            case ExamKind::TASK:
                $histories = MemberLectureProgressRateHistoriesModel::getHistories($memberLectureProgramModel);
                $rate = $this->getHistoriesTotalProgressRate($histories, $memberLectureProgramModel);
                // 총 진도율이 80% 이상인지 확인
                throw_if($rate < 80, new NeedProgressException("총 진도율이 80% 를 넘어야 합니다."));
        }
        return true;
    }

    public function getScore(string $type, $lectureExamSubmits, MemberLectureProgramModel $program): int
    {
        $score = 0;
        switch ($type) {
            case ExamKind::MIDDLE->value :
                $perScore = 100 / $lectureExamSubmits->count();
                $score = $lectureExamSubmits->map(function ($exam) use ($perScore) {
                    $exam->score = $exam->answer == $exam->exam->answer ? $perScore : 0;
                    $exam->save();
                    return $exam;
                })->sum('score');
                break;
            case ExamKind::FINAL->value :
                $filterAndSum = function ($collection, ExamType|array $type, $perScore) {
                    return $collection->filter(function ($exam) use ($type) {
                        if ($type instanceof ExamType) {
                            return $exam->exam->exam_type == $type->value;
                        } else {
                            return collect($type)->reduce(function ($carry, $item) use ($exam) {
                                return $carry || ($exam->exam->exam_type == $item->value);
                            }, false);
                        }
                    })
                        ->map(function ($exam) use ($perScore) {
                            $exam->score = $exam->answer == $exam->exam->answer ? $perScore : 0;
                            $exam->save();
                            return $exam;
                        })->sum('score');
                };
                $score = 0;
                $score += $filterAndSum($lectureExamSubmits, [ExamType::MULTIPLE, ExamType::AUTHENTIC], $program->lectureProgram->lecture->information->multiple_choice_score);
                $score += $filterAndSum($lectureExamSubmits, ExamType::SHORT, $program->lectureProgram->lecture->information->short_answer_score);
                $score += $filterAndSum($lectureExamSubmits, ExamType::SUBJECTIVE, $program->lectureProgram->lecture->information->narrative_score);
                break;
            case ExamKind::TASK->value :
                break;
        }
        return $score;
    }

    private function getTotalProgressRate(int $rate, MemberLectureProgramModel $memberLectureProgram): int
    {
        return $rate / $memberLectureProgram->lectureProgram->lecture->classes->count();
    }

    protected function createModel(LectureProgramModel $model): self
    {
        return MemberLectureProgramModel::create([
            // 'member_idx' => $member->idx,
            'lecture_program_idx' => $model->idx,
            'learning_start_date' => $model->getLearningEndDate(),
            'learning_end_date' => $model->getLearningEndDate(),
            'review_end_date' => $model->getReviewEndDate(),
        ]);
    }
}
