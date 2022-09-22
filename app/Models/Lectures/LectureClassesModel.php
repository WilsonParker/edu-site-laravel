<?php


namespace App\Models\Lectures;


use App\Models\Common\BaseModel;
use App\Models\Members\MemberLectureClassesModel;
use App\Models\Members\MembersModel;

class LectureClassesModel extends BaseModel
{
    protected $table = 'lecture_classes';

    public function lecture(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(LecturesModel::class);
    }

    public function members(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        return $this->hasManyThrough(MembersModel::class, MemberLectureClassesModel::class);
    }

    public function getPreviousLectureClass(): self
    {
        return $this->where([
            'lecture_idx' => $this->lecture_idx,
            'number' => $this->number - 1,
        ])->first();
    }
}
