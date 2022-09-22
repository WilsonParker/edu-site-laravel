<?php

use Illuminate\Database\Schema\Blueprint;

class CreateTbAttendHistV2 extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected bool $timestamp = false;
    protected bool $softDelete = false;

    /*
     * 수강 이력
     * 훈련기관에서 개설된 수업을 수강하는 수강자 정보를 저장한다.
     * 훈련기관에서 저장하고 있는 모든 수강 정보가 수집 대상이 되며, 실제 수강자는 수집 시 수강 확정 여부 항목으로 구분한다.
     * */
    protected string $table = 'tb_attend_hist_v2';

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
         $table->boolean('pass_flag')->nullable(false)->comment('수료 여부');
         $table->boolean('attend_valid_flag')->nullable(false)->comment('수강 확정 여부, 수집 당시 수강 신청 중 또는 취소된 경우가 있을 수 있으므로 실제 수강자와 구분하기 위해 필요');
         $table->string('book_isbn', 400)->nullable(false)->comment('우편 과정 수강자 일 때, 수강자가 학습하는 도서 ISBN 을 저장, 2권 이상일 경우 "," 로 구분하여 저장');
         $table->enum('change_state', ['C', 'U', 'D'])->nullable(false)->comment('변경 상태, [C:등록, U:수정, D:삭제]');
         $table->timestamp('reg_date')->nullable(false)->useCurrent()->comment('등록 일시');
         $table->enum('emp_ins_flag', [0, 1, 2, 3, 4])->nullable(false)->comment('고용보험환급과정여부, 정부지원이 이루어지는 수업인지 구분, [0:비환급과정, 1:사업주훈련, 2:컨소시엄, 3:실업자훈련, 4:근로자훈련]');
     }

}
