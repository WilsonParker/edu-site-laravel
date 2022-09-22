<?php

use Illuminate\Database\Schema\Blueprint;

class CreateLectureClassAnswer extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'lecture_class_answer';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedInteger('idx')->autoIncrement()->comment('고유키');
        $table->unsignedInteger('lecture_class_question_idx')->nullable(false)->comment('LectureClassesQuestion 참조');
        $table->unsignedInteger('member_idx')->nullable(false)->comment('Members 참조');
        $table->text('answer')->nullable(false)->comment('답변');

        $table->foreign('member_idx')->on('members')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();
        $table->foreign('lecture_class_question_idx')->on('lecture_class_question')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();
    }

}
