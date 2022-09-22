<?php

namespace App\OriginModels\Boards;

use App\OriginModels\Common\BaseModel;

//FAQ 테이블
class FaqModel extends BaseModel
{
    protected $table = 'lms_faq';
    protected $primaryKey = 'f_id';

    protected $casts = [
        'regdate' => 'date'
    ];
}
