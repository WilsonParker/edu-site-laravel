<?php

use Illuminate\Database\Schema\Blueprint;

class CreateSubjectMatterExpert extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'subject_matter_expert';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedInteger('idx')->autoIncrement()->comment('고유키');
        $table->string('name', 32)->nullable(false)->comment('이름');
        $table->text('introduction')->nullable(false)->comment('소개');
    }
}
