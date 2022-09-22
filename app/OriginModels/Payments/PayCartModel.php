<?php

namespace App\OriginModels\Payments;

use App\OriginModels\Common\BaseModel;
use App\OriginModels\Lectures\ClassModel;

//결제 테이블
class PayCartModel extends BaseModel
{
    protected $table = 'lms_pay_cart';
    protected $primaryKey = 'no';

    public function class(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ClassModel::class, 'class_id', 'class_id');
    }

}
