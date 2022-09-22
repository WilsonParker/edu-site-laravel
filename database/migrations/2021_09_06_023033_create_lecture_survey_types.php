<?php

use Illuminate\Database\Schema\Blueprint;

class CreateLectureSurveyTypes extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'lecture_survey_types';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->string('code', 32)->primary()->comment('고유키');
        $table->string('name', 32)->nullable(false)->comment('이름');
        $table->string('description', 128)->nullable(true)->comment('설명');
    }
}
