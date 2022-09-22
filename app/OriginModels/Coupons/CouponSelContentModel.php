<?php

namespace App\OriginModels\Coupons;

use App\OriginModels\Common\BaseModel;

//페이지이동 변수시 임시 저장
class CouponSelContentModel extends BaseModel
{
    protected $table = 'lms_coupon_sel_content';
    protected $primaryKey = 'no';
}
