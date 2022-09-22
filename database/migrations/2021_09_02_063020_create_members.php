<?php

use Illuminate\Database\Schema\Blueprint;

class CreateMembers extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'members';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedInteger('idx')->autoIncrement()->comment('고유키');
        $table->string('id', 32)->nullable(false)->unique()->comment('아이디');
        $table->text('pw')->nullable(false)->comment('패스워드');
        $table->rememberToken();
    }

}
