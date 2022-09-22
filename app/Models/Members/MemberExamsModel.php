<?php


namespace App\Models\Members;


use App\Models\Common\BaseModel;
use App\Models\Lectures\ExamStatus;
use App\Models\Lectures\ExamStatusModel;
use App\Models\Lectures\ExamTypesModel;
use App\Models\Lectures\LectureExamSubmitsModel;
use Awobaz\Compoships\Compoships;

class MemberExamsModel extends BaseModel
{
    use Compoships;

    protected $table = 'member_exams';

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'certification' => 'boolean',
    ];

    public function examType(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ExamTypesModel::class);
    }

    public function examStatus(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ExamStatusModel::class);
    }

    public function memberLectureProgram(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MemberLectureProgramModel::class);
    }

    public function lectureExamSubmits(): \Awobaz\Compoships\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(LectureExamSubmitsModel::class);
    }

    public function sameTypeLectureExamSubmits(): \Awobaz\Compoships\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(LectureExamSubmitsModel::class, ['member_lecture_program_idx', 'exam_type_code'], ['member_lecture_program_idx', 'kind']);
    }

    /**
     * 시험 채점 완료 여부
     * @return bool
     * @author  dev9163
     * @added   2021/12/27
     * @updated 2021/12/27
     */
    public function isComplete(): bool
    {
        return $this->exam_status_code == ExamStatus::COMPLETE->value;
    }

    /**
     * 해설 표시 여부
     * @return bool
     * @author  dev9163
     * @added   2021/12/24
     * @updated 2021/12/24
     */
    public function showCommentary(): bool
    {
        return $this->isComplete() || $this->exam_status_code == ExamStatus::WAITING->value;
    }

    public function getScore(): string
    {
        return match ($this->exam_status_code) {
            'none' => '미제출',
            'waiting_for_grading' => '채점중',
            'complete_grading' => $this->score,
        };
    }
}
