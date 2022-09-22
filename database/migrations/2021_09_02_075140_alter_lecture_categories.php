<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterLectureCategories extends \LaravelSupports\Libraries\Supports\Databases\Migrations\AlterMigration
{
    protected string $table = 'lecture_categories';

    function defaultUpTemplate(Blueprint $table)
    {
        $table->foreign('parent')->on('lecture_categories')->references('code')->cascadeOnUpdate();
    }

    protected function defaultDownTemplate(Blueprint $table)
    {
        $table->dropForeign('lecture_categories_parent_foreign');
    }
}
