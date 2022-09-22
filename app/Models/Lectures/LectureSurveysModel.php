<?php


namespace App\Models\Lectures;


use App\Models\Common\BaseModel;

class LectureSurveysModel extends BaseModel
{
    protected $table = 'lecture_surveys';

    public function type(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(LectureSurveySubmitsModel::class);
    }

    public function lecture(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(LectureSurveysModel::class);
    }

    public function lectureSurveySubmits(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(LectureSurveySubmitsModel::class);
    }
}
