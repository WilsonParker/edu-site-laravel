<?php

use Illuminate\Database\Schema\Blueprint;

class CreateMemberExams extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'member_exams';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedInteger('idx')->autoIncrement()->comment('시험 종류 고유키 참조');
        // $table->unsignedInteger('member_idx')->nullable(false)->comment('회원 고유키 참조');
        $table->unsignedInteger('member_lecture_program_idx')->nullable(false)->comment('회원 강의 운영 과정 고유키 참조');
        $table->string('exam_type_code', 32)->nullable(false)->comment('시험 종류 고유키 참조');
        $table->string('exam_status_code', 32)->nullable(false)->comment('시험 상태 고유키 참조');
        $table->boolean('certification')->default(false)->nullable(false)->comment('인증 여부 (OTP)');
        $table->boolean('agree')->default(false)->nullable(false)->comment('시험 동의 여부');
        $table->unsignedTinyInteger('score')->default(0)->nullable(false)->comment('점수');
        $table->string('ip', 16)->nullable(false)->comment('접속 IP');
        $table->timestamp('start')->useCurrent()->nullable(false)->comment('시작일');
        $table->timestamp('end')->nullable(true)->comment('종료일');

        // $table->foreign('member_idx')->on('members')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();
        $table->foreign('member_lecture_program_idx')->on('member_lecture_program')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();
        $table->foreign('exam_type_code')->on('exam_types')->references('code')->cascadeOnUpdate();
        $table->foreign('exam_status_code')->on('exam_status')->references('code')->cascadeOnUpdate();

        // $table->unique(['member_idx', 'member_lecture_program_idx', 'exam_type_code'], 'member_exams_unique');
        $table->unique(['member_lecture_program_idx', 'exam_type_code'], 'member_exams_unique');
    }

}
