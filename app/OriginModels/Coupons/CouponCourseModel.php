<?php

namespace App\OriginModels\Coupons;

use App\OriginModels\Common\BaseModel;

//발급된 쿠폰의 과정정보
class CouponCourseModel extends BaseModel
{
    protected $table = 'lms_coupon_course';
    protected $primaryKey = 'no';
}
