<?php

use LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration;
use Illuminate\Database\Schema\Blueprint;

/**
 * error log 를 기록하는 table 입니다
 *
 * @author  dew9163
 * @added   2020/06/03
 * @updated 2020/06/03
 */
class ExceptionLogs extends CreateMigration
{

    protected string $table = "exception_logs";

    /**
     * Run the migrations.
     * @param Blueprint $table
     * @return void
     */
    function defaultUpTemplate(Blueprint $table)
    {
        $table->integerIncrements('ix')->comment('고유키');
        $table->string('code', 64)->nullable(false)->comment('에러 코드');
        $table->text('message')->nullable(false)->comment('에러 메시지');
        $table->string('url', 1024)->nullable(false)->comment('에러가 발생한 주소');
        $table->string('file', 256)->nullable(false)->comment('에러가 발생한 파일 이름');
        $table->string('class', 256)->nullable(false)->comment('에러가 발생한 클래스');
        $table->text('trace')->nullable(false)->comment('에러 내용');
    }


}
