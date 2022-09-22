<?php

use Illuminate\Database\Schema\Blueprint;

class CreateMemberLectureProgram extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'member_lecture_program';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedInteger('idx')->autoIncrement()->comment('고유키');
        $table->unsignedInteger('member_idx')->nullable(false)->comment('회원 고유키 참조');
        $table->unsignedInteger('lecture_program_idx')->nullable(false)->comment('강의 운영 과정 참조');
        $table->timestamp('learning_start_date')->nullable(false)->comment('수강 시작일');
        $table->timestamp('learning_end_date')->nullable(false)->comment('수강 종료일');
        $table->timestamp('review_end_date')->nullable(false)->comment('복습 종료일');
        $table->unsignedDecimal('rate', 3)->nullable(false)->default(0)->comment('진도율');

        $table->foreign('member_idx')->on('members')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();
        $table->foreign('lecture_program_idx', 'member_lecture_cardinal_numbers_lecture_program_foreign')->on('lecture_program')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();
    }

}
