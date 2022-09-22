<?php


namespace App\Models\Lectures;


use App\Models\Common\BaseModel;

class LectureInformationModel extends BaseModel
{
    protected $table = 'lecture_information';

    public function lecture(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(LecturesModel::class);
    }
}
