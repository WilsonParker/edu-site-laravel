<?php

use Illuminate\Database\Schema\Blueprint;

class CreateLectureSurveys extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'lecture_surveys';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedInteger('idx')->autoIncrement()->comment('고유키');
        $table->string('lecture_survey_type_code', 32)->nullable(false)->comment('설문척도(CONTENT : 교육내용, TUTOR : 교강사(튜터), OPERATION : 교육운영, LMS : LMS, SUPPORT : 학습지원도구, ETC : 기타)');
        $table->string('title', 64)->nullable(false)->comment('제목');
        $table->text('contents')->nullable(false)->comment('내용');

        $table->foreign('lecture_survey_type_code')->on('lecture_survey_types')->references('code')->cascadeOnUpdate()->cascadeOnDelete();
    }

}
