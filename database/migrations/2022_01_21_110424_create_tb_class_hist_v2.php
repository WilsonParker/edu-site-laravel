<?php

use Illuminate\Database\Schema\Blueprint;

class CreateTbClassHistV2 extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected bool $timestamp = false;
    protected bool $softDelete = false;

    /*
     * 수업 이력
     * 훈련기관이 등록한 과정으로 개설한 수업정보가 쌓이게 된다.
     * 수업이란 수강자가 수강 신청을 하게 된느 단위의 정보이다.
     * 수업은 훈련기관에 따라 차수, 기수 강좌 또는 계약 과정 등으로 다르게 표현될 수 있으며, 하나의 과정에는 1개 이상의 수업이 생성된다.
     * */
    protected string $table = 'tb_class_hist_v2';

    /**
     * Run the migrations.
     *
     * @return void
     */
    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedInteger('seq')->autoIncrement()->comment('순번');
        $table->string('course_agent_pk', 150)->nullable(false)->comment('과정 정보의 PK / Lectures');
        $table->string('class_agent_pk', 150)->nullable(false)->comment('수업 정보의 PK / LectureClasses');
        $table->unsignedDecimal('full_score', 10)->nullable(false)->comment('만점, 수업을 통해 수강자가 최종으로 획득할 수 있는 최고 점수 (100점 만점 환산)');
        $table->string('start_dt', 8)->nullable(false)->comment('수업 시작일, YYYYMMDD');
        $table->string('end_dt', 8)->nullable(false)->comment('수업 종료일, YYYYMMDD');
        $table->enum('emp_ins_flag', [0, 1, 2, 3, 4])->nullable(false)->comment('고용보험환급과정여부, 정부지원이 이루어지는 수업인지 구분, [0:비환급과정, 1:사업주훈련, 2:컨소시엄, 3:실업자훈련, 4:근로자훈련]');
        $table->boolean('valid_flag')->nullable(false)->comment('유효 여부, 임시 또는 삭제 과정이 아닌 실제로 운영 중이거나 운영했던 과정을 의미');
        $table->enum('change_state', ['C', 'U', 'D'])->nullable(false)->comment('변경 상태, [C:등록, U:수정, D:삭제]');
        $table->timestamp('reg_date')->nullable(false)->useCurrent()->comment('등록 일시');
        $table->unsignedDecimal('tracse_time', 10)->nullable(false)->useCurrent()->comment('회차, 해당 수업의 회차 정보를 입력 (HRD-Net 행정지원시스템과 동일값)');
    }

}
