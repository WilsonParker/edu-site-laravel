<?php

use Illuminate\Database\Schema\Blueprint;

class CreateLectureCompanies extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'lecture_companies';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedSmallInteger('idx')->autoIncrement()->comment('고유키');
        $table->string('name', 64)->nullable(false)->comment('업체명');
        $table->unsignedInteger('fees')->default(0)->nullable(false)->comment('수수료');
    }
}
