<?php

namespace App\OriginModels\Site;

use App\OriginModels\Common\BaseModel;

//팝업테이블
class PopupModel extends BaseModel
{
    protected $table = 'lms_popup';
    protected $primaryKey = 'pp_id';
}
