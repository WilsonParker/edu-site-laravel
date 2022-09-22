<?php


namespace App\Models\Coupons;


use App\Models\Common\BaseCodeModel;
use App\Models\Payments\PaymentsModel;
use App\Models\Traits\BelongsToMemberTrait;

class CouponBenefitTypesModel extends BaseCodeModel
{
    protected $table = 'coupon_benefit_types';

    public function couponBenefits(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CouponBenefitsModel::class);
    }
}
