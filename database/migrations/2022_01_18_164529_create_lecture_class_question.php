<?php

use Illuminate\Database\Schema\Blueprint;

class CreateLectureClassQuestion extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'lecture_class_question';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedInteger('idx')->autoIncrement()->comment('고유키');
        $table->unsignedInteger('member_lecture_program_idx')->nullable(false)->comment('MemberLectureProgram 참조');
//        $table->unsignedInteger('lecture_class_idx')->nullable(false)->comment('LectureClasses 참조');
//        $table->unsignedTinyInteger('page')->nullable(false)->comment('lecture class page');
        $table->string('title', 64)->nullable(false)->comment('제목');
        $table->text('content')->nullable(false)->comment('내용');

        $table->foreign('member_lecture_program_idx')->on('member_lecture_program')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();
//        $table->foreign('lecture_class_idx')->on('lecture_classes')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();

//        $table->index(['member_lecture_program_idx', 'lecture_class_idx'], 'lecture_class_question_member_IX');
    }

}
