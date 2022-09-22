<?php


namespace App\Models\Lectures;


use App\Models\Common\BaseModel;
use App\Models\Members\MemberLectureProgramModel;

class LectureClassQuestionModel extends BaseModel
{
    protected $table = 'lecture_class_question';

    public function memberLecture(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MemberLectureProgramModel::class);
    }

    public function lectureClass(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(LectureClassesModel::class);
    }
}
