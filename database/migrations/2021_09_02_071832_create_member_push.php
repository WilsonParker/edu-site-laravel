<?php

use Illuminate\Database\Schema\Blueprint;

class CreateMemberPush extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'member_push';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedInteger('idx')->autoIncrement()->comment('고유키');
        $table->unsignedInteger('member_idx')->nullable(false)->comment('회원 고유키 참조');
        $table->boolean('sms_agree')->default(true)->nullable(false)->comment('문자발송동의');
        $table->boolean('email_agree')->default(true)->nullable(false)->comment('이메일발송동의');

        $table->foreign('member_idx')->on('members')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();
    }

}
