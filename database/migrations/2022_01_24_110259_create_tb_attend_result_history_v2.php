<?php

use Illuminate\Database\Schema\Blueprint;

class CreateTbAttendResultHistoryV2 extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected bool $timestamp = false;
    protected bool $softDelete = false;

    /*
     * 수강 종료 이력
     * 수업이 종료되는 시점에 산출되는 정보를 수집한다.
     * */
    protected string $table = 'tb_attend_result_history_v2';

    /**
     * Run the migrations.
     *
     * @return void
     */
    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedInteger('seq')->autoIncrement()->comment('순번');
        $table->string('user_agent_pk', 150)->nullable(false)->comment('훈련기관 회원 PK / Members');
        $table->string('course_agent_pk', 150)->nullable(false)->comment('훈련기관 과정 PK / Lectures');
        $table->string('class_agent_pk', 150)->nullable(false)->comment('훈련기관 수업 PK / Classes');
        $table->unsignedDecimal('total_score', 10)->nullable(false)->comment('총점, 수강자가 수강을 마친 후 최종으로 획득한 점수 (100점 만점 기준 환산 점수) 를 저장');
        $table->unsignedDecimal('progress_rate', 10)->nullable(false)->comment('진도율, 수강자가 수강을 마친 후 최종으로 획득한 진도율을 백분율로 저장');
        $table->enum('change_state', ['C', 'U', 'D'])->nullable(false)->comment('변경 상태, [C:등록, U:수정, D:삭제]');
        $table->timestamp('reg_date')->nullable(false)->useCurrent()->comment('등록 일시');
        $table->boolean('pass_flag')->nullable(false)->comment('수료 여부, 수강자가 수업을 수료했는지 여부를 저장');
    }

}
