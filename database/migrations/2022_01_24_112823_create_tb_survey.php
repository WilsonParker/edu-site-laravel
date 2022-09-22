<?php

use Illuminate\Database\Schema\Blueprint;

class CreateTbSurvey extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected bool $timestamp = false;
    protected bool $softDelete = false;

    /*
     * 설문
     * 설문조사가 이루어지는 목적을 포함하고 있는 설문의 기본 정보를 저장 한다.
     * */
    protected string $table = 'tb_survey';

    /**
     * Run the migrations.
     *
     * @return void
     */
     protected function defaultUpTemplate(Blueprint $table)
     {
         $table->unsignedInteger('seq')->autoIncrement()->comment('순번');
         $table->string('survey_cate_id', 50)->nullable(false)->comment('설문 분류 ID, 조사 목적에 따라 설문을 분류하기 위해 사용되는 고유값 / Lecture_Survey_Types');
         $table->string('survey_id', 50)->nullable(false)->comment('설문 ID / Lecture_Surveys');
         $table->string('survey_cate_name', 200)->nullable(false)->comment('설문 분류명');
         $table->string('survey_title', 2000)->nullable(false)->comment('설문 제목');
         $table->string('survey_target', 400)->nullable(false)->comment('설문 대상, 설문에 응답할 수 있는 대상자의 범위, 설문 대상을 지정하여 설문조사가 이루어지는 경우 해당 정보를 저장, 없는 경우 빈 값, 예) 전체회원, 수강자, 수강 신청자, 수강 수료자 등');
         $table->timestamp('reg_date')->nullable(false)->useCurrent()->comment('등록 일시');
     }

}
