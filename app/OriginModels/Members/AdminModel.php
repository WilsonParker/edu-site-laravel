<?php

namespace App\OriginModels\Members;

use App\OriginModels\Common\BaseModel;

//매니저 테이블
class AdminModel extends BaseModel
{
    protected $table = 'lms_admin';
    protected $primaryKey = 'uid';
}
