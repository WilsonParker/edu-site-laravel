<?php

use Illuminate\Database\Schema\Blueprint;

class CreateLectureNBCOrders extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'lecture_nbc_orders';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedInteger('idx')->autoIncrement()->comment('고유키');
        $table->string('nbc_type_code', 32)->nullable(false)->comment('NBCTypes 참조');
        $table->unsignedBigInteger('payment_idx')->nullable(false)->comment('결제 참조');
        $table->unsignedInteger('member_idx')->nullable(true)->comment('회원 참조 - 승인 요청한 관리자');
        $table->timestamp('approved_at')->nullable(true)->comment('승인 날짜');

        $table->foreign('nbc_type_code')->on('nbc_types')->references('code')->cascadeOnUpdate();
        $table->foreign('payment_idx')->on('payments')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();
        $table->foreign('member_idx')->on('members')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();
    }

}
