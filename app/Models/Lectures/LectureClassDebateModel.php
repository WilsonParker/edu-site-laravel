<?php


namespace App\Models\Lectures;


use App\Models\Common\BaseModel;
use App\Models\Members\MemberLectureProgramModel;

class LectureClassDebateModel extends BaseModel
{
    protected $table = 'lecture_class_debate';

    public function memberLecture(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MemberLectureProgramModel::class);
    }

    public function lectureClass(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(LectureClassesModel::class);
    }
}
