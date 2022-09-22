<?php

namespace App\OriginModels\Lectures;

use App\OriginModels\Common\BaseModel;

//과정차수 테이블
class ClassModel extends BaseModel
{
    protected $table = 'lms_class';
    protected $primaryKey = 'class_id';
}
