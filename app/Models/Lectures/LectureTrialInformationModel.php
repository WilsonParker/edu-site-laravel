<?php


namespace App\Models\Lectures;


use App\Models\Common\BaseModel;

class LectureTrialInformationModel extends BaseModel
{
    protected $table = 'lecture_trial_information';

    public function lecture(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(LecturesModel::class);
    }
}
