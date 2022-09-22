<?php

use Illuminate\Database\Schema\Blueprint;

class CreateSession extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'session';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedInteger('idx')->autoIncrement()->comment('고유키');
        $table->string('id', 512)->nullable(false)->unique()->comment('id');
        $table->string('sid', 512)->nullable(false)->unique()->comment('sid');
        $table->string('data', 512)->nullable(false)->comment('data');
        $table->timestamp('expires_at')->nullable(false)->comment('expires_at');
    }

}
