<?php


namespace App\Models\Lectures;


use App\Models\Common\BaseCodeModel;

class LectureTypesModel extends BaseCodeModel
{
    protected $table = 'lecture_types';

    public function lectures(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        return $this->hasManyThrough(LecturesModel::class,LectureTypePivotModel::class);
    }

}
