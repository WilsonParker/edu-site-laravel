<?php

use Illuminate\Database\Schema\Blueprint;

class CreateBoardCategoryTypePivot extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'board_category_type_pivot';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedSmallInteger('idx')->autoIncrement()->comment('고유키');
        $table->string('board_type_code', 32)->nullable(false)->comment('BoardTypes 참조');
        $table->string('board_category_code', 32)->nullable(false)->comment('BoardCategories 참조');

        $table->foreign('board_type_code')->on('board_types')->references('code')->cascadeOnUpdate()->cascadeOnDelete();
        $table->foreign('board_category_code')->on('board_categories')->references('code')->cascadeOnUpdate()->cascadeOnDelete();
    }

}
