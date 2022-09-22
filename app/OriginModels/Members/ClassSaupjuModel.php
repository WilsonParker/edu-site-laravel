<?php

namespace App\OriginModels\Members;

use App\OriginModels\Common\BaseModel;

//사업주 홈페이지 노출
class ClassSaupjuModel extends BaseModel
{
    protected $table = 'lms_class_saupju';
    protected $primaryKey = 'class_id';
}
