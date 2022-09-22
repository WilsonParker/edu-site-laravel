<?php

use Illuminate\Database\Schema\Blueprint;

class CreateLectureSurveyQuestions extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'lecture_survey_questions';

    /**
     * Run the migrations.
     *
     * @return void
     */
    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedInteger('idx')->autoIncrement()->comment('고유키');
        $table->unsignedInteger('lecture_survey_idx')->nullable(false)->comment('강의 설문 참조');
        $table->string('content', 64)->nullable(false)->comment('질문');
        $table->unsignedTinyInteger('sort')->nullable(false)->default(0)->comment('순서');

        $table->foreign('lecture_survey_idx')->on('lecture_surveys')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();
    }

}
