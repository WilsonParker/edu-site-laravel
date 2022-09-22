<?php

use Illuminate\Database\Schema\Blueprint;

class CreateLectureCategoryPivot extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'lecture_category_pivot';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedInteger('idx')->autoIncrement()->comment('고유키');
        $table->unsignedInteger('lecture_idx')->nullable(false)->comment('강의 참조');
        $table->string('lecture_category_code',32 )->nullable(false)->comment('강의 카테고리 참조');

        $table->foreign('lecture_idx')->on('lectures')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();
        $table->foreign('lecture_category_code')->on('lecture_categories')->references('code')->cascadeOnUpdate()->cascadeOnDelete();
    }

}
