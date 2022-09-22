<?php

use Illuminate\Database\Schema\Blueprint;

class CreateLectureExamSubmits extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'lecture_exam_submits';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedInteger('idx')->autoIncrement()->comment('고유키');
        $table->unsignedInteger('exam_idx')->nullable(false)->comment('평가 정보 고유키 참조');
        $table->unsignedInteger('member_exam_idx')->nullable(false)->comment('회원 시험 고유키 참조');
        $table->unsignedTinyInteger('sort')->default(1)->nullable(false)->comment('순서');
        $table->text('answer')->nullable(true)->comment('수강생 정답');
        $table->text('correction')->nullable(true)->comment('첨삭');
        $table->unsignedTinyInteger('score')->default(0)->nullable(false)->comment('점수');
        $table->unsignedBigInteger('attachment_idx')->nullable(true)->comment('첨부파일');

        $table->foreign('exam_idx')->on('lecture_exams')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();
        $table->foreign('member_exam_idx')->on('member_exams')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();
        $table->foreign('attachment_idx')->on('resources')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();

        $table->unique(['member_exam_idx', 'exam_idx'], 'lecture_exam_submits_unique');
    }

}
