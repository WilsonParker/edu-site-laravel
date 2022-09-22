<?php

use Illuminate\Database\Schema\Blueprint;

class CreateLectureTutor extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'lecture_tutor';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedInteger('idx')->autoIncrement()->comment('고유키');
        $table->unsignedInteger('lecture_idx')->nullable(false)->comment('강의 고유키 참조');
        $table->unsignedInteger('member_idx')->nullable(false)->comment('교강사 고유키 참조');

        $table->foreign('lecture_idx')->on('lectures')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();
        $table->foreign('member_idx')->on('members')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();
    }

}
