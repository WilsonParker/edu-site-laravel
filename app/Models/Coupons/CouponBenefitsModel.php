<?php


namespace App\Models\Coupons;


use App\Models\Common\BaseModel;

class CouponBenefitsModel extends BaseModel
{
    protected $table = 'coupon_benefits';

    public function coupon(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CouponsModel::class);
    }

    public function couponBenefitType(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CouponBenefitTypesModel::class);
    }
}
