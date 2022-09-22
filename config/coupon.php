<?php


use App\Services\Membership\MembershipService;
use FlyBookModels\Members\DusanCouponUsedMemberModel;
use FlyBookModels\Membership\MembershipPriceModel;
use Illuminate\Database\Eloquent\Model;
use LaravelSupports\Libraries\Coupon\Contracts\Coupon;
use LaravelSupports\Libraries\Coupon\Contracts\CouponBenefit;
use LaravelSupports\Libraries\Coupon\Contracts\CouponCondition;
use LaravelSupports\Libraries\Coupon\Contracts\MembershipCoupon;
use LaravelSupports\Libraries\Pay\Common\Contracts\Price;
use LaravelSupports\Libraries\Pay\PaymentService;
use LaravelSupports\Libraries\Supports\Date\DateHelper;

$VALUE_TYPE_INTEGER = 'integer';
$VALUE_TYPE_UNSIGNED_INTEGER = 'unsigned_integer';
$VALUE_TYPE_STRING = 'string';
$VALUE_TYPE_BOOLEAN = 'boolean';
$VALUE_TYPE_ARRAY = 'array';
$VALUE_TYPE_COLLECTION = 'collection';

$DATA_KEY_PRICE = 'price';
$DATA_KEY_MEMBER = 'member';

if (!function_exists('buildCouponCollection')) {
    function buildCouponCollection($callback, $valueType, $values)
    {
        return [
            'callback' => $callback,
            'value_type' => $valueType,
            'values' => $values,
        ];
    }
}

if (!function_exists('buildCouponCondition')) {
    function buildCouponCondition($callback, $valueType = null)
    {
        return buildCouponCollection($callback, $valueType, null);
    }
}

if (!function_exists('buildBenefit')) {
    function buildBenefit($callback, $valueType = null, $values = null)
    {
        return buildCouponCollection($callback, $valueType, $values);
    }
}

return [
    'condition_types' => [

        /**
         * 멤버십 회원 이거나 아닐 때 사용 가능 합니다
         * value : true | false
         *
         * @author  dew9163
         * @added   2020/06/19
         * @updated 2020/06/19
         */
        'is_membership' => buildCouponCondition(function (CouponCondition $condition, Model $member, $data) {
            return $member->isMembership() == $condition->getCouponValue();
        }, $VALUE_TYPE_BOOLEAN),

        /**
         * 멤버십 구독 방식을 이용 중 이거나 아닐 때 사용 가능 합니다
         * value : true | false
         *
         * @author  dew9163
         * @added   2020/06/19
         * @updated 2020/06/19
         */
        'is_subscriber' => buildCouponCondition(function (CouponCondition $condition, Model $member, $data) {
            return $member->isSubscribe() == $condition->getCouponValue();
        }, $VALUE_TYPE_BOOLEAN),

        /**
         * 멤버십을 참조 여부를 확인 합니다
         * value : true | false
         * sub_value : $membership_type
         * ex) standard_1m_subscribe, premium_6m ...
         *
         * @author  dew9163
         * @added   2020/07/06
         * @updated 2020/07/06
         */
        'reference_membership' => buildCouponCondition(function (CouponCondition $condition, Model $member, Price $price) {
            return ($price->getID() == $condition->getCouponSubValue()) == $condition->getCouponValue();
        }, $VALUE_TYPE_BOOLEAN),

        /**
         * 멤버십 첫 결제 여부를 확인 합니다
         * value : true | false
         *
         * @author  dew9163
         * @added   2020/07/22
         * @updated 2020/07/22용
         */
        'is_first_membership_payment' => buildCouponCondition(function (CouponCondition $condition, Model $member, $data) {
            return $condition->getCouponValue() == $member->isFirstMembershipPayment();
        }, $VALUE_TYPE_BOOLEAN),
    ],

    'benefit_types' => [

        /**
         * 가격을 ? 만큼 ?번 할인 합니다
         *
         * @author  dew9163
         * @added   2020/07/10
         * @updated 2020/07/10
         */
        'price_discount' => buildBenefit(function (Coupon $coupon, CouponBenefit $benefit, Model $member, Price $price) {
            $origin_price = $price->getPrice();
            $sale = (int)$benefit->getCouponValue();
            $paid = $origin_price - $sale;
            $paid = $paid > 0 ? $paid : 0;

            return [
                'price' => $origin_price,
                'sale_amount' => $sale,
                'pay_amount' => $paid,
                'benefit_count' => $benefit->getCouponBenefitCount(),
            ];
        }),

        /**
         * 가격을 ?% 만큼 (최대 ?) 할인 합니다
         *
         * @author  dew9163
         * @added   2020/06/16
         * @updated 2020/06/16
         * @todo
         * 테스트 필요
         */
        'price_percent_discount' => buildBenefit(function (Coupon $coupon, CouponBenefit $benefit, Model $member, Price $price) {
            $origin_price = $price->getPrice();
            $sale = (int)($origin_price * ((int)$benefit->getCouponValue() / 100));
            $sale = $sale < $benefit->getCouponSubValue() ? $sale : $benefit->getCouponSubValue();
            $paid = $origin_price - $sale;

            return [
                'price' => $origin_price,
                'sale_amount' => $sale,
                'pay_amount' => $paid,
                'benefit_count' => $benefit->getCouponBenefitCount(),
            ];
        }),

        // 멤버십을 ? 날짜 단위 만큼 혜택을 제공 합니다
        'provide_membership' => buildBenefit(function (MembershipCoupon $coupon, CouponBenefit $benefit, Model $member, $data) {
            $service = new MembershipService($member);
            $plusMember = $service->addMembership($benefit->getCouponValue(), $benefit->getCouponSubValue(), $benefit->getCouponThirdValue());
            $plusMember->save();
            return $plusMember;
        }),

        // 멤버십 상품을 참조하여 혜택을 제공 합니다
        'provide_reference_membership' => buildBenefit(function (MembershipCoupon $coupon, CouponBenefit $benefit, Model $member, $data) {
            $service = new MembershipService($member);
            $plusMember = $service->addMembershipWithCoupon($coupon, $benefit, $member);
            $plusMember->save();
            return $plusMember;
        }),
    ]
];
