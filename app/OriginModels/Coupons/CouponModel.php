<?php

namespace App\OriginModels\Coupons;

use App\OriginModels\Common\BaseModel;
use App\OriginModels\Members\MembersModel;

//쿠폰테이블
class CouponModel extends BaseModel
{
    protected $table = 'lms_coupon';
    protected $primaryKey = 'no';

    public function member(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(MembersModel::class, 'user_id', 'user_id');
    }

    public function mcoupon(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(McouponModel::class, 'cp_id', 'code_name');
    }
}
