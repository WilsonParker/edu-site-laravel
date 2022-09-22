<?php

use Illuminate\Database\Schema\Blueprint;

class CreateLectureSurveyQuestionItems extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'lecture_survey_question_items';

    /**
     * Run the migrations.
     *
     * @return void
     */
     protected function defaultUpTemplate(Blueprint $table)
     {
         $table->unsignedInteger('idx')->autoIncrement()->comment('고유키');
         $table->unsignedInteger('lecture_question_idx')->nullable(false)->comment('강의 설문 질문 참조');
         $table->enum('type', ['subjective', 'multiple'])->nullable(false)->comment('질문 유형(SUBJECTIVE : 주관식, MULTIPLE : 객관식)');
         $table->string('content', 64)->nullable(false)->comment('질문 문항 내용');
         $table->unsignedTinyInteger('score')->nullable(false)->comment('점수');
         $table->unsignedTinyInteger('sort')->nullable(false)->default(0)->comment('순서');

         $table->foreign('lecture_question_idx')->on('lecture_survey_questions')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();
     }

}
