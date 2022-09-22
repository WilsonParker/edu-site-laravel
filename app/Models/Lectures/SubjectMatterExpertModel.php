<?php


namespace App\Models\Lectures;


use App\Models\Common\BaseModel;

class SubjectMatterExpertModel extends BaseModel
{
    protected $table = 'subject_matter_expert';

    public function lecture(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(LecturesModel::class,LectureSubjectMatterExpertModel::class);
    }
}
