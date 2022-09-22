<?php

namespace App\OriginModels\Lectures;

use App\OriginModels\Common\BaseModel;

//과정 타입
class CourseTypeModel extends BaseModel
{
    protected $table = 'lms_course_type';
    protected $primaryKey = 'no';
}
