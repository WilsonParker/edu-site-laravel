<?php

namespace App\OriginModels\Payments;

use App\OriginModels\Common\BaseModel;
use App\OriginModels\Lectures\ClassModel;

//결제 테이블
class PayModel extends BaseModel
{
    protected $table = 'lms_pay';
    protected $primaryKey = 'pay_id';

    protected $casts = [
        'startday' => 'date',
        'endday' => 'date',
        'pay_regdate' => 'date',
        'order_regdate' => 'date',
    ];

    public function cart(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(PayCartModel::class, 'pay_id', 'pay_id');
    }

    public function class(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ClassModel::class, 'class_id', 'class_id');
    }
}
