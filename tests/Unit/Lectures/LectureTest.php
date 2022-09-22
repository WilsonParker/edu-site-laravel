<?php

namespace Tests\Unit\Lectures;

use App\Models\Lectures\ExamKind;
use App\Models\Lectures\ExamStatus;
use App\Models\Lectures\LectureProgramModel;
use App\Models\Members\MemberLectureProgramModel;
use App\Models\Members\MembersModel;
use App\Services\Lectures\LectureService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class LectureTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDate()
    {
        $model = LectureProgramModel::first();
        dump($model->getLearningStartDate());
        dump($model->getLearningEndDate());
    }

    public function testCreateLecture()
    {
        $member = MembersModel::find(6176);
        $lectures = LectureProgramModel::first();
        $service = new LectureService($member);
        $service->provides($lectures);
    }

    public function testEndedProgram()
    {
        MemberLectureProgramModel::getEndedLectureInBeforeQuery()
            ->with(['member', 'notEndedMemberLectureExams.lectureExamSubmits'])
            ->where('member_idx', 5502)
            ->get()
            ->each(function ($item) {
                $item->notEndedMemberLectureExams->each(function ($exam) use ($item) {
                    $service = new LectureService($item->member);
                    $type = ExamKind::from($exam->exam_type_code);
                    $exam->end = now();
                    $exam->exam_status_code = $type == ExamKind::TASK->value ? ExamStatus::WAITING : ExamStatus::COMPLETE;
                    $exam->score = $service->getScore($type, $exam->lectureExamSubmits, $item);
                    $exam->save();
                });
            });
    }

    public function testEndedExam() {

    }

}
