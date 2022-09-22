<?php

use Illuminate\Database\Schema\Blueprint;

class CreateLectureNcsCategories extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'lecture_ncs_categories';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->string('code', 32)->primary()->comment('고유키');
        $table->string('name', 64)->nullable(false)->comment('이름');
        $table->string('number_code', 64)->nullable(false)->comment('숫자 코드');
    }
}
