<?php


namespace App\Models\Lectures;


use App\Models\Common\ResourceableModel;
use App\Models\Common\ResourcesModel;
use App\Models\Members\MemberExamsModel;
use App\Models\Members\MemberLectureProgramModel;
use App\Models\Members\MembersModel;
use App\Models\Traits\ResourceTrait;
use Awobaz\Compoships\Compoships;

class LectureExamSubmitsModel extends ResourceableModel
{
    use ResourceTrait, Compoships;

    protected $table = 'lecture_exam_submits';

    public function exam(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(LectureExamsModel::class);
    }

    public function member(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MembersModel::class);
    }

    public function memberLectureProgram(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MemberLectureProgramModel::class);
    }

    public function attachment(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ResourcesModel::class, 'idx', 'attachment_idx');
    }

    public function getResourcePath(): string
    {
        return '/lectures/exams/submits';
    }

    public static function createModel(MemberExamsModel $memberExamsModel, LectureExamsModel $lectureExamsModel, int $sort = 0)
    {
        return self::create([
            'member_exam_idx' => $memberExamsModel->idx,
            'exam_idx' => $lectureExamsModel->idx,
            'sort' => $sort,
        ]);
    }
}
