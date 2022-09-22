<?php

use Illuminate\Database\Schema\Blueprint;

class CreateLectureTypes extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'lecture_types';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->string('code', 32)->primary()->comment('고유키');
        $table->string('name', 64)->nullable(false)->comment('이름');
        $table->string('description', 256)->nullable(false)->comment('설명');
    }
}
