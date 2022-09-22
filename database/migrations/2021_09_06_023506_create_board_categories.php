<?php

use Illuminate\Database\Schema\Blueprint;

class CreateBoardCategories extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'board_categories';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->string('code', 32)->primary()->comment('고유키');
        $table->string('name', 32)->nullable(false)->comment('제목');
        $table->unsignedTinyInteger('sort')->default(0)->nullable(false)->comment('정렬 순서');
        $table->boolean('is_public')->default(true)->nullable(false)->comment('표시 여부');
    }
}
