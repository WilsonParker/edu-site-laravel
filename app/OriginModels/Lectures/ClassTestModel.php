<?php

namespace App\OriginModels\Lectures;

use App\OriginModels\Common\BaseModel;

/**
 * 최종 평가
 * @author  dev9163
 * @added   2021/09/17
 * @updated 2021/09/17
 */
class ClassTestModel extends BaseModel
{
    protected $table = 'lms_class_test';
    protected $primaryKey = 'test_id';

    public function jumsu(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ClassJumsuModel::class, 'course_id', 'course_id')->where('gubun', '2');
    }
}
