<?php

use Illuminate\Database\Schema\Blueprint;

class CreateLectureSurveySubmits extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'lecture_survey_submits';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedInteger('idx')->autoIncrement()->comment('고유키');
        $table->unsignedInteger('member_lecture_program_idx')->nullable(false)->comment('강의 참조');
        $table->unsignedInteger('survey_idx')->nullable(false)->comment('강의 설문 참조');
        $table->unsignedInteger('survey_question_idx')->nullable(false)->comment('강의 설문 질문 참조');
        $table->unsignedInteger('survey_question_item_idx')->nullable(false)->comment('강의 설문 질문 아이템 참조');
        $table->text('answer')->nullable(true)->comment('수강생 응답');

        $table->foreign('member_lecture_program_idx')->on('member_lecture_program')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();
        $table->foreign('survey_idx')->on('lecture_surveys')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();
        $table->foreign('survey_question_idx')->on('lecture_survey_questions')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();

        $table->unique(['member_lecture_program_idx', 'survey_idx', 'survey_question_idx'], 'lecture_survey_submits_program_survey_unique');
    }

}
