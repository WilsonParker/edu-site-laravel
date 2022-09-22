<?php

use Illuminate\Database\Schema\Blueprint;

class CreateTbSurveyQuestItem extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    /*
     * 설문 문항 보기
     * 한 개의 문항에는 2개 이상의 보기가 제공된다.
     * 만약, 설문 문항 정보에 설문 보기 정보를 함께 저장하고 있는 경우,
     * 설문 보기 수 만큼 나누어서 설문 문항 보기 수집 테이블에 저장한다.
     * */
    protected string $table = 'tb_survey_quest_item';

    /**
     * Run the migrations.
     *
     * @return void
     */
     protected function defaultUpTemplate(Blueprint $table)
     {
         $table->unsignedInteger('seq')->autoIncrement()->comment('순번');
         $table->string('survey_cate_id', 50)->nullable(false)->comment('설문 분류 ID / Lecture_Survey_Types');
         $table->string('survey_id', 50)->nullable(false)->comment('설문 ID / Lecture_Surveys');
         $table->string('quest_id', 50)->nullable(false)->comment('문항 ID / Lecture_Survey_Questions');
         $table->string('rule_id', 50)->nullable(false)->comment('설문 척도 ID, 척도가 없는 경우 빈 값으로 저장');
         $table->string('item_id', 50)->nullable(false)->comment('문항 보기 ID / Lecture_Survey_Question_Items');
         $table->string('item_content', 2000)->nullable(false)->comment('보기 내용 / Lecture_Survey_Question_Items content');
         $table->string('rule_name', 200)->nullable(false)->comment('척도명 (아주 못함, 아주 잘함 등)');
         $table->unsignedDecimal('rule_point', 10,2)->nullable(false)->comment('척도 점수, 척도명이 "아주 못함" 이고 점수가 10 일 때, 저장 값은 70 임');
         $table->timestamp('reg_date')->nullable(false)->useCurrent()->comment('등록 일시');
     }

}
