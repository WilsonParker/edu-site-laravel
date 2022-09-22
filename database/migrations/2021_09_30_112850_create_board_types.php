<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoardTypes extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'board_types';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->string('code', '32')->primary()->comment('고유키');
        $table->string('name', '32')->comment('이름');
    }

}
