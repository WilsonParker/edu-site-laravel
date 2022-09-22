<?php

use Illuminate\Database\Schema\Blueprint;

class CreateMemberLectureClasses extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'member_lecture_classes';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedInteger('idx')->autoIncrement()->comment('고유키');
        $table->unsignedInteger('member_idx')->nullable(false)->comment('회원 고유키 참조');
        $table->unsignedInteger('member_lecture_program_idx')->nullable(false)->comment('강의 운영 과정 고유키 참조');
        $table->unsignedInteger('lecture_class_idx')->nullable(false)->comment('강의 차시 고유키 참조');
        $table->boolean('certification')->nullable(false)->default(false)->comment('인증 여부 (OTP)');

        $table->foreign('member_idx')->on('members')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();
        $table->foreign('member_lecture_program_idx')->on('member_lecture_program')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();
        $table->foreign('lecture_class_idx')->on('lecture_classes')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();

        $table->unique(['member_idx', 'member_lecture_program_idx', 'lecture_class_idx'], 'member_lecture_classes_unique');
    }

}
