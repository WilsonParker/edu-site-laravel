<?php

use Illuminate\Database\Schema\Blueprint;

class CreateTBSurveyQuestAnswer extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{

    /*
     * 설문 응답
     * 설문 응답 정보를 저장할 때 설문 문항과 관계가 유지되도록 한다.
     * 설문 응답 정보를 통해 설문 응답자가 어떤 설문에 응답을 하였는지 추적이 가능해야 한다.
     * */
    protected string $table = 'tb_survey_quest_answer';

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

         $table->string('target_user_id', 50)->nullable(true)->comment('');
         $table->string('answer_user_id', 50)->nullable(false)->comment('');
         $table->string('course_agent_pk', 150)->nullable(false)->comment('');
         $table->string('class_agent_pk', 150)->nullable(false)->comment('');
         $table->string('obj_answer_rule_id', 50)->nullable(false)->comment('');
         $table->string('obj_answer_item_id', 50)->nullable(false)->comment('');
         $table->string('subj_answer', 4000)->nullable(false)->comment('');


         $table->timestamp('reg_date')->nullable(false)->useCurrent()->comment('등록 일시');
     }

}
