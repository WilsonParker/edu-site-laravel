<?php

use Illuminate\Database\Schema\Blueprint;

class CreateTbSurveyQuest extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected bool $timestamp = false;
    protected bool $softDelete = false;

    /*
     * 설문 문항
     * 훈련기관의 설문 단위 정보 하위에 포함되어 있는 정보
     * 하나의 설문에는 1개 이상의 묺아으로 구성되어 있다
     * */
    protected string $table = 'tb_survey_quest';

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
         $table->string('quest_id', 200)->nullable(false)->comment('문항 ID / Lecture_Quest');
         $table->string('quest_cate_name', 200)->nullable(false)->comment('설문 문항 분류명 (과정 만족도, 강의 수준 만족도, 학습자 만족도) ');
         $table->string('quest_type', 50)->nullable(false)->comment('문항 유형 (객관식, 주관식)');
         $table->string('quest_content', 2000)->nullable(false)->comment('문항 내용');
         $table->timestamp('reg_date')->nullable(false)->useCurrent()->comment('등록 일시');
     }

}
