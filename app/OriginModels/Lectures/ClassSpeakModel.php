<?php

namespace App\OriginModels\Lectures;

use App\OriginModels\Common\BaseModel;

// 강의 문의
class ClassSpeakModel extends BaseModel
{
    protected $table = 'lms_class_speak';
    protected $primaryKey = 'sp_id';
}
