<?php

use Illuminate\Database\Schema\Blueprint;

class CreatePaymentItems extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'payment_items';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedBigInteger('idx')->autoIncrement()->comment('고유키');
        $table->unsignedBigInteger('payment_idx')->nullable(false)->comment('결제 고유키 참조');
        $table->unsignedInteger('lecture_program_idx')->nullable(false)->comment('강의 운영 과정 참조');
        $table->enum('status', ['ready', 'paid', 'cancelled', 'failed'])->default('ready')->nullable(false)->comment('상태 값');

        $table->unsignedInteger('price')->nullable(false)->comment('정가');
        $table->unsignedInteger('sale_price')->default(0)->nullable(false)->comment('할인금액');
        $table->unsignedInteger('paid_price')->default(0)->nullable(false)->comment('지불금액');
        $table->unsignedInteger('canceled_price')->default(0)->nullable(false)->comment('환불 금액');
        $table->string('canceled_reason', 128)->nullable(true)->comment('환불 사유');
        $table->timestamp('cancelled_at')->nullable(true)->comment('환불일');

        $table->foreign('payment_idx')->on('payments')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();
        $table->foreign('lecture_program_idx')->on('lecture_program')->references('idx')->cascadeOnUpdate();
    }

}
