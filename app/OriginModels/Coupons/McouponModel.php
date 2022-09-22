<?php

namespace App\OriginModels\Coupons;

use App\OriginModels\Common\BaseModel;

//할인코드 마스터 테이블
class McouponModel extends BaseModel
{
    protected $table = 'lms_mcoupon';
    protected $primaryKey = 'coupon_id';

    public function coupons(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CouponModel::class, 'cp_id', 'code_name');
    }
}
