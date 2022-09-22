<?php


namespace App\Models\Lectures;


use App\Models\Common\BaseModel;
use App\Models\Traits\BelongsToMemberTrait;

class LectureClassAnswerModel extends BaseModel
{
    use BelongsToMemberTrait;

    protected $table = 'lecture_class_answer';

    public function question(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(LectureClassQuestionModel::class);
    }

}
