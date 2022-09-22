<?php


namespace App\Models\Members;


use App\Models\Common\BaseModel;
use App\Models\Lectures\ExamKind;
use App\Models\Lectures\LectureExamSubmitsModel;
use App\Models\Lectures\LectureProgramModel;
use App\Models\Traits\BelongsToMemberTrait;
use Awobaz\Compoships\Compoships;

class MemberLectureProgramModel extends BaseModel
{
    use Compoships, BelongsToMemberTrait;

    protected $table = 'member_lecture_program';

    public function lectureProgram(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(LectureProgramModel::class, 'idx', 'lecture_program_idx');
    }

    public function memberExams(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(MemberExamsModel::class, 'member_lecture_program_idx', 'member_lecture_program_idx');
    }

    public function notEndedMemberLectureExams(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->memberExams()->whereNull('end')->orWhereDate('end', '>', now());
    }

    public function getMemberLectureMiddleExam(): ?MemberExamsModel
    {
        return $this->filterMemberLectureExam(ExamKind::MIDDLE);
    }

    public function getMemberLectureFinalExam(): ?MemberExamsModel
    {
        return $this->filterMemberLectureExam(ExamKind::FINAL);
    }

    public function getMemberLectureTaskExam(): ?MemberExamsModel
    {
        return $this->filterMemberLectureExam(ExamKind::TASK);
    }

    public function lectureExamSubmits(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        return $this->hasManyThrough(LectureExamSubmitsModel::class, MemberExamsModel::class);
    }

    /**
     * type 에 따른 exam 필터
     * @param ExamKind $type
     * @return MemberExamsModel|null
     * @author  dev9163
     * @added   2021/11/22
     * @updated 2021/11/22
     */
    public function filterMemberLectureExam(ExamKind $type): ?MemberExamsModel
    {
        return $this->memberExams->first(function ($exam) use ($type) {
            return $exam->exam_type_code == $type->value;
        });
    }

    public function getLectureMiddleExamSubmits(): \Illuminate\Database\Eloquent\Collection|array
    {
        return $this->filterLectureExamSubmits(ExamKind::MIDDLE);
    }

    public function getLectureFinalExamSubmits(): \Illuminate\Database\Eloquent\Collection|array
    {
        return $this->filterLectureExamSubmits(ExamKind::FINAL);
    }

    public function getLectureTaskExamSubmits(): \Illuminate\Database\Eloquent\Collection|array
    {
        return $this->filterLectureExamSubmits(ExamKind::TASK);
    }

    /**
     * type 에 따른 exam submit 필터
     * @param ExamKind $type
     * @return
     * @author  dev9163
     * @added   2021/12/27
     * @updated 2021/12/27
     */
    public function filterLectureExamSubmits(ExamKind $type): \Illuminate\Database\Eloquent\Collection|array
    {
        return $this->lectureExamSubmits()->whereHas('exam', function ($query) use ($type) {
            $query->where('kind', $type->value);
        })->get();
    }

    public function getClassCount(): int
    {
        return $this->lectureProgram->lecture->classes->count();
    }

    public function getMiddleClassNumber(): int
    {
        return $this->getClassCount() / 2;
    }

    public static function getEndedLectureQuery()
    {
        return self::whereDate('learning_end_date', '<', now());
    }

    public static function getEndedLectureInBeforeQuery()
    {
        $now = now();
        $yesterday = now();
        $yesterday->day = $now->day - 1;
        $yesterday = $yesterday->format('Y-m-d');
        return self::whereBetween('learning_end_date', [$yesterday, $now]);
    }
}
