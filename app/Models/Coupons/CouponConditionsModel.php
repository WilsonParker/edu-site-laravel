<?php


namespace App\Models\Coupons;


use App\Models\Common\BaseModel;

class CouponConditionsModel extends BaseModel
{
    protected $table = 'coupon_conditions';

    public function coupon(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(CouponsModel::class);
    }

    public function couponConditionType(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(CouponConditionTypesModel::class);
    }
}
