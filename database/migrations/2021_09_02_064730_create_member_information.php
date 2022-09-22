<?php

use Illuminate\Database\Schema\Blueprint;

class CreateMemberInformation extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'member_information';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedInteger('idx')->autoIncrement()->comment('고유키');
        $table->unsignedInteger('member_idx')->nullable(false)->comment('회원 고유키 참조');
        $table->string('name', 16)->nullable(false)->comment('이름');
        $table->string('front_rg_number', 8)->nullable(false)->comment('주민등록번호 앞자리');
        $table->string('back_rg_number', 8)->nullable(false)->comment('주민등록번호 앞자리');
        $table->string('phone_number', 16)->nullable(false)->comment('핸드폰번호');
        $table->string('home_number', 16)->nullable(true)->comment('집전화번호');
        $table->string('email', 32)->nullable(false)->comment('이메일');
        $table->string('zip_code', 16)->nullable(false)->comment('우편번호');
        $table->string('address', 128)->nullable(false)->comment('주소');
        $table->string('detail_address', 128)->nullable(false)->comment('상세주소');

        $table->rememberToken();
        $table->timestamp('email_verified_at')->nullable();

        $table->foreign('member_idx')->on('members')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();
    }

}
