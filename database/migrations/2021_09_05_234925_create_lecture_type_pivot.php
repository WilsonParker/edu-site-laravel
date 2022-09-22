<?php

use Illuminate\Database\Schema\Blueprint;

class CreateLectureTypePivot extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'lecture_type_pivot';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedBigInteger('idx')->autoIncrement()->comment('고유키');
        $table->string('lecture_type_code', 32)->nullable(false)->comment('강의 유형 참조');
        $table->unsignedInteger('lecture_idx')->nullable(false)->comment('강의 참조');

        $table->foreign('lecture_type_code')->on('lecture_types')->references('code')->cascadeOnUpdate()->cascadeOnDelete();
        $table->foreign('lecture_idx')->on('lectures')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();

        $table->unique(['lecture_idx', 'lecture_type_code']);
    }

}
