<?php

use Illuminate\Database\Schema\Blueprint;

class CreateLectureExams extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'lecture_exams';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedInteger('idx')->autoIncrement()->comment('고유키');
        $table->unsignedInteger('lecture_idx')->nullable(false)->comment('강의 고유키 참조');
        $table->enum('kind', ['middle', 'final', 'task'])->nullable(false)->comment('종류( MIDDLE : 중간평가, FINAL : 최종평가, TASK : 과제)');
        $table->enum('exam_type', ['subjective', 'multiple', 'authentic', 'short'])->nullable(false)->comment('문제 유형(SUBJECTIVE : 주관식, MULTIPLE : 객관식, AUTHENTIC : 진위형, SHORT : 단답형)');
        $table->unsignedTinyInteger('number')->nullable(false)->comment('문제 번호');
        $table->text('contents')->nullable(true)->comment('문제 내용');
        $table->text('explanation')->nullable(true)->comment('해설(채점 기준)');
        $table->text('first_question')->nullable(true)->comment('보기1');
        $table->text('second_question')->nullable(true)->comment('보기2');
        $table->text('third_question')->nullable(true)->comment('보기3');
        $table->text('fourth_question')->nullable(true)->comment('보기4');
        $table->text('answer')->nullable(true)->comment('정답');

        $table->unsignedBigInteger('attachment_idx')->nullable(true)->comment('첨부파일');
        $table->unsignedBigInteger('commentary_idx')->nullable(true)->comment('해설파일');
        $table->unsignedBigInteger('answer_idx')->nullable(true)->comment('정답파일');

        $table->foreign('lecture_idx')->on('lectures')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();
        $table->foreign('attachment_idx')->on('resources')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();
        $table->foreign('answer_idx')->on('resources')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();
        $table->foreign('commentary_idx')->on('resources')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();

        $table->index(['kind']);
    }

}
