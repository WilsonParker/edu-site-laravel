<?php

use Illuminate\Database\Schema\Blueprint;

class CreatePopUpTypes extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'pop_up_types';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->string('code', 32)->primary()->comment('고유키');
        $table->string('name', 32)->comment('이름');
        $table->string('description', 256)->comment('설명');
    }
}
