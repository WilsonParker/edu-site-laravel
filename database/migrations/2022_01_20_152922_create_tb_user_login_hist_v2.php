<?php

use Illuminate\Database\Schema\Blueprint;

class CreateTbUserLoginHistV2 extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected bool $timestamp = false;
    protected bool $softDelete = false;

    /*
     * 회원 로그인 이력
     * 회원 로그인 정보를 저장한다.
     * trigger 를 작성할 때, 회원 로그인 정보가 독립적인 테이블로 분리 된 경우 등록이 발생한 경우에만 저장하도록 한다.
     * */
    protected string $table = 'tb_user_login_hist_v2';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedInteger('seq')->autoIncrement()->comment('순번');
        $table->string('user_agent_pk', 150)->nullable(false)->comment('훈련기관 회원PK / Members');
        $table->timestamp('login_date')->nullable(false)->useCurrent()->comment('로그인 시간');
        $table->string('login_ip', 15)->nullable(false)->comment('로그인 IP');
    }
}
