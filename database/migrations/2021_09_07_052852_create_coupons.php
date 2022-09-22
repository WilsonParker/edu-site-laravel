<?php

use Illuminate\Database\Schema\Blueprint;

class CreateCoupons extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'coupons';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->string('code', 32)->primary()->comment('고유키');
        $table->string('name', 64)->nullable(false)->comment('이름');
        $table->string('description', 256)->nullable(false)->comment('설명');
        $table->unsignedInteger('limit')->nullable(false)->comment('사용 가능 제한 수');
        $table->string('duplicated_code', 64)->nullable(false)->comment('중복 방지 코드');
        $table->timestamp('start')->nullable(false)->useCurrent()->comment('사용 가능 시작일');
        $table->timestamp('end')->nullable(false)->useCurrent()->comment('사용 가능 종료일');
        $table->boolean('is_enabled')->default(true)->nullable(false)->comment('활성화 여부');
    }
}
