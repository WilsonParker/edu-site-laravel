<?php

namespace App\OriginModels\Lectures;

use App\OriginModels\Common\BaseModel;

/**
 * 과정테이블
 * @author  dev9163
 * @added   2021/09/17 4:52 오후
 * @updated 2021/09/17
 */
class CourseModel extends BaseModel
{
    protected $table = 'lms_course';
    protected $primaryKey = 'course_id';

    public function lmsClass(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ClassModel::class, 'course_id', 'course_id')->whereIn('course_type', ['2', '3']);
    }
}
