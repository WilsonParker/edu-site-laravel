<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLectureCategories extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'lecture_categories';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->string('code',32)->primary()->comment('고유키');
        $table->string('parent', 32)->nullable(true)->comment('상위 참조');
        $table->string('name', 64)->nullable(false)->comment('제목');
        $table->string('number_code', 64)->nullable(true)->comment('숫자 코드');
        $table->unsignedInteger('sort')->default(0)->nullable(false)->comment('정렬순서');
        $table->boolean('is_public')->default(true)->nullable(false)->comment('표시여부');
    }
}
