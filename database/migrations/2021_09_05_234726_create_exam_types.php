<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamTypes extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'exam_types';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->string('code', 32)->primary()->comment('고유키');
        $table->string('name', 64)->nullable(false)->comment('이름');
        $table->string('description', 128)->nullable(true)->comment('설명');
    }
}
