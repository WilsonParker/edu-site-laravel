<?php

use Illuminate\Database\Schema\Blueprint;

class CreatePayments extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'payments';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedBigInteger('idx')->autoIncrement()->comment('고유키');
        $table->unsignedInteger('member_idx')->nullable(false)->comment('회원 고유키 참조');
        $table->string('payment_method_code', 32)->nullable(true)->comment('결제 방법 고유키 참조');
        $table->string('coupon_code', 32)->nullable(true)->comment('쿠폰 고유키 참조');
        $table->enum('status', ['ready', 'paid', 'cancel', 'fail'])->default('ready')->nullable(false)->comment('결제상태(READY : 결제대기, PAID: 결제완료, CANCEL: 결제취소, fail: 결제실패)');
        $table->string('name', 256)->nullable(false)->comment('이름');
        $table->string('description', 256)->nullable(true)->comment('설명');

        $table->string('request_id', 64)->nullable(true)->unique(true)->comment('가맹점 고유 주문 번호 (iamport : merchant uid)');
        $table->string('unique_id', 64)->nullable(true)->comment('고유 결제번호 (iamport : imp_uid)');
        $table->string('subscribe_id', 64)->nullable(true)->comment('정기구독 번호 (iamport : custom uid)');
        $table->string('pg_unique_id', 64)->nullable(true)->comment('PG사 거래 고유 번호 (iamport : pg_tid)');
        $table->string('pg_provider', 32)->nullable(true)->comment('결제 PG 사 (iamport : pg_provider)');
        $table->string('receipt_url', 256)->nullable(true)->comment('영수증 주소');
//        $table->string('token', 64)->nullable(true)->unique()->comment('payment token');

        $table->unsignedInteger('price')->nullable(false)->comment('정가');
        $table->unsignedInteger('sale_price')->default(0)->nullable(false)->comment('할인 금액');
        $table->unsignedInteger('paid_price')->default(0)->nullable(false)->comment('결제 금액');
        $table->unsignedInteger('canceled_price')->default(0)->nullable(false)->comment('환불 금액');

        $table->string('depositor', 32)->nullable(true)->comment('입금자');
        $table->string('card_approval', 128)->nullable(true)->comment('카드 승인 번호');
        $table->string('card_name', 32)->nullable(true)->comment('결제 카드 이름');
        $table->string('card_number', 32)->nullable(true)->comment('결제 카드 번호');
        $table->unsignedTinyInteger('card_quota')->nullable(false)->default(0)->comment('결제 카드 번호');
        $table->string('vbank_number', 32)->nullable(true)->comment('가상계좌 입금계좌번호');
        $table->string('vbank_name', 32)->nullable(true)->comment('가상계좌 은행명');
        $table->timestamp('vbank_date')->nullable(true)->comment('가상계좌 입금기한');
        $table->timestamp('paid_at')->nullable(true)->comment('결제 날짜');

        $table->foreign('member_idx')->on('members')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();
        $table->foreign('coupon_code')->on('coupons')->references('code')->cascadeOnUpdate();
        $table->foreign('payment_method_code')->on('payment_methods')->references('code')->cascadeOnUpdate();
    }

}

