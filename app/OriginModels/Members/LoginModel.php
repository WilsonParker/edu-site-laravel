<?php

namespace App\OriginModels\Members;

use App\OriginModels\Common\BaseModel;

// 로그인
class LoginModel extends BaseModel
{
    protected $table = 'lms_login';
    protected $primaryKey = 'idx';
}
