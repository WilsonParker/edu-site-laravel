<?php

use Illuminate\Database\Schema\Blueprint;

class CreateLectureProgramTutorPivot extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'lecture_program_tutor_pivot';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedInteger('idx')->autoIncrement()->comment('고유키');
        $table->unsignedInteger('lecture_program_idx')->nullable(false)->comment('강의 운영 과정 참조');
        $table->unsignedInteger('member_idx')->nullable(false)->comment('교강사 참조');

        $table->foreign('lecture_program_idx')->on('lecture_program')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();
        $table->foreign('member_idx')->on('members')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();
    }

}
