<?php

namespace App\OriginModels\Sms;

use App\OriginModels\Common\BaseModel;

//문자메시지로 보낸 메시지를 저장
class MmsModel extends BaseModel
{
    protected $table = 'lms_mms';
}
