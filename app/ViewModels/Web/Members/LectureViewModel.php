<?php

namespace App\ViewModels\Web\Members;

use App\Models\Lectures\ExamStatus;
use App\Models\Members\MemberExamsModel;
use App\Models\Members\MemberLectureProgramModel;
use App\Models\Members\MembersModel;
use App\ViewModels\Common\BaseViewModel;
use Illuminate\Support\Carbon;

class LectureViewModel extends BaseViewModel
{
    public bool $hasMiddleExam = false;
    public bool $hasFinalExam = false;
    public bool $hasTaskExam = false;
    public MembersModel $member;
    public ?MemberLectureProgramModel $memberLectureProgramModel = null;
    public $exams;

    public function setMemberLectureProgramModel(MemberLectureProgramModel $model)
    {
        $this->memberLectureProgramModel = $model;
        $this->hasMiddleExam = $model->lectureProgram->lecture->hasMiddleExams();
        $this->hasFinalExam = $model->lectureProgram->lecture->hasFinalExams();
        $this->hasTaskExam = $model->lectureProgram->lecture->hasTaskExams();
    }

    public function getMiddleExamText(): string
    {
        if ($this->hasMiddleExam) {
            $exam = $this->memberLectureProgramModel->getMemberLectureMiddleExam();
            if (isset($exam)) {
                return $exam->getScore();
            } else {
                return '미응시';
            }
        } else {
            return '미대상';
        }
    }

    public function getFinalExamText(): string
    {
        if ($this->hasFinalExam) {
            $exam = $this->memberLectureProgramModel->getMemberLectureFinalExam();
            if (isset($exam)) {
                return $exam->getScore();
            } else {
                return '미응시';
            }
        } else {
            return '미대상';
        }
    }

    public function getTaskExamText(): string
    {
        if ($this->hasTaskExam) {
            $exam = $this->memberLectureProgramModel->getMemberLectureTaskExam();
            if (isset($exam)) {
                return $exam->getScore();
            } else {
                return '미응시';
            }
        } else {
            return '미대상';
        }
    }

    /**
     * 시험 제출 상태 메시지 전달
     *
     * @param MemberExamsModel|null $model
     * @return string
     * @author  dev9163
     * @added   2021/12/27
     * @updated 2021/12/27
     */
    public function getExamStatusText(?MemberExamsModel $model): string
    {
        $code = $model->exam_status_code ?? ExamStatus::NONE->value;
        return ExamStatus::from($code)->text();
    }

    /**
     * 총 교육 시간 문자열 제공
     * @param $time
     * @return string
     * @author  dev9163
     * @added   2022/01/03
     * @updated 2022/01/03
     */
    public function getTotalTimeText($time): string
    {
        $second = $time % 60;
        $minute = round(($time - $second) / 60, 1);
        return "{$minute}분 {$second}초";
    }

    /**
     * 시험 진행 시간 문자열 제공
     * @param MemberExamsModel|null $exam
     * @return string
     * @author  dev9163
     * @added   2022/01/04
     * @updated 2022/01/04
     */
    public function getExamTimeText(?MemberExamsModel $exam): string
    {
        if(isset($exam)) {
            return "{$exam->start} ~ {$exam->end}";
        } else {
            return "";
        }
    }
}
