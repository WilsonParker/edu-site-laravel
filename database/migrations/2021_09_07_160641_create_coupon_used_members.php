<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponUsedMembers extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'coupon_used_members';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedInteger('idx')->autoIncrement()->comment('고유키');
        $table->string('coupon_code', 32)->nullable(false)->comment('쿠폰 고유키 참조');
        $table->unsignedInteger('member_idx')->nullable(false)->comment('회원 고유키 참조');

        $table->foreign('coupon_code')->on('coupons')->references('code')->cascadeOnUpdate()->cascadeOnDelete();
        $table->foreign('member_idx')->on('members')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();

        $table->unique(['member_idx', 'coupon_code']);
    }

}
