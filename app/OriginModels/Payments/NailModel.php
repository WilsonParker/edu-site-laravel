<?php

namespace App\OriginModels\Payments;

use App\OriginModels\Common\BaseModel;

// 내일 배움 카드 결제 요청
class NailModel extends BaseModel
{
    protected $table = 'lms_nail';
    protected $primaryKey = 'no';

    protected $casts = [
        'startday' => 'date',
        'endday' => 'date',
        'regdtae' => 'date',
    ];

}
