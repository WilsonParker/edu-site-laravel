<?php

use Illuminate\Database\Schema\Blueprint;

class CreateBusinessInformation extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'business_information';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedInteger('idx')->autoIncrement()->comment('고유키');
        $table->unsignedInteger('member_idx')->nullable(false)->comment('회원 고유키 참조');
        $table->string('business_type_code', 32)->nullable(false)->comment('사업주 유형 고유키 참조');
        $table->string('company_name', 16)->nullable(false)->comment('업체명');
        $table->string('business_conditions', 64)->nullable(false)->comment('업태');
        $table->string('business_type', 64)->nullable(false)->comment('업종');
        $table->string('business_rg_number', 16)->nullable(false)->unique()->comment('사업자등록번호');
        $table->string('manager_name', 16)->nullable(false)->comment('담당자이름');
        $table->string('manager_phone', 16)->nullable(false)->comment('담당자핸드폰번호');
        $table->string('tax_email', 32)->nullable(false)->comment('세금계산서용 이메일');
        $table->string('homepage_url', 128)->nullable(true)->comment('홈페이지');
        $table->text('memo')->nullable(true)->comment('메모');

        $table->foreign('member_idx')->on('members')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();
        $table->foreign('business_type_code')->on('business_types')->references('code')->cascadeOnUpdate()->cascadeOnDelete();
    }
}
