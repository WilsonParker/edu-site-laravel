<?php

use Illuminate\Database\Schema\Blueprint;

class CreateLectureInformation extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'lecture_information';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedInteger('idx')->autoIncrement()->comment('고유키');
        $table->unsignedInteger('lecture_idx')->nullable(false)->comment('강의 고유키 참조');
        $table->unsignedTinyInteger('mid_multiple_choice_count')->nullable(false)->comment('중간 평가 객관식 문제 수');
        $table->unsignedTinyInteger('final_multiple_choice_count')->nullable(false)->comment('최종 평가 객관식 문제 수');
        $table->unsignedTinyInteger('final_short_answer_count')->nullable(false)->comment('최종 평가 단답형 문제 수');
        $table->unsignedTinyInteger('final_narrative_count')->nullable(false)->comment('최종 평가 서술형 문제 수');
        $table->unsignedTinyInteger('multiple_choice_score')->nullable(false)->comment('객관식 개당 점수');
        $table->unsignedTinyInteger('short_answer_score')->nullable(false)->comment('단답형 개당 점수');
        $table->unsignedTinyInteger('narrative_score')->nullable(false)->comment('서술형 개당 점수');
        $table->unsignedTinyInteger('mid_evaluation_count')->nullable(false)->comment('중간 평가 수');
        $table->unsignedTinyInteger('final_evaluation_count')->nullable(false)->comment('최종 평가 수');
        $table->unsignedTinyInteger('problem_count')->nullable(false)->comment('과제 수');
        $table->unsignedTinyInteger('final_exam_time')->nullable(false)->default(60)->comment('최종 시험 제한 시간 (분)');

        $table->foreign('lecture_idx')->on('lectures')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();
    }

}
