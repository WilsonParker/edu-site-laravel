<?php

use Illuminate\Database\Schema\Blueprint;

class CreateSms extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'sms';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedBigInteger('idx')->autoIncrement()->comment('고유키');
        $table->unsignedInteger('member_idx')->nullable(false)->comment('회원 고유키 참조');
        $table->unsignedInteger('lecture_idx')->nullable(true)->comment('강의 참조');
        $table->enum('status', ['ready', 'success', 'failed'])->nullable(false)->comment('발송상태(준비, 성공, 실패)');
        $table->string('template_code', 128)->nullable(false)->comment('문자 템플릿 코드');
        $table->string('phone_number', 16)->nullable(false)->comment('핸드폰번호');
        $table->text('contents')->nullable(false)->comment('문자내용');
        $table->timestamp('reserve_at')->nullable(false)->useCurrent()->comment('예약 발송시간');
        $table->timestamp('sended_at')->nullable(true)->comment('발송시간');

        $table->foreign('member_idx')->on('members')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();
        $table->foreign('lecture_idx')->on('lectures')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();
    }

}
