<?php


namespace App\Models\Coupons;


use App\Models\Common\BaseCodeModel;
use App\Models\Payments\PaymentsModel;

class CouponsModel extends BaseCodeModel
{
    protected $table = 'coupons';

    public function payments(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(PaymentsModel::class);
    }

    public function couponConditions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CouponConditionsModel::class);
    }

    public function couponBenefits(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CouponBenefitsModel::class);
    }
}
