<?php

use Illuminate\Database\Schema\Blueprint;

class CreateCouponBenefits extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'coupon_benefits';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedInteger('idx')->autoIncrement()->comment('고유키');
        $table->string('coupon_code', 32)->nullable(false)->comment('쿠폰 고유키 참조');
        $table->string('coupon_benefit_type_code', 32)->nullable(false)->comment('쿠폰 혜택 고유키 참조');
        $table->string('value', 32)->nullable(true);
        $table->string('sub_value', 32)->nullable(true);
        $table->string('third_value', 32)->nullable(true);

        $table->foreign('coupon_code')->on('coupons')->references('code')->cascadeOnUpdate()->cascadeOnDelete();
        $table->foreign('coupon_benefit_type_code')->on('coupon_benefit_types')->references('code')->cascadeOnUpdate();
    }

}
