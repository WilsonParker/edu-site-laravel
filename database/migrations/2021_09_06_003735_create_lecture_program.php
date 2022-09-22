<?php

use Illuminate\Database\Schema\Blueprint;

class CreateLectureProgram extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'lecture_program';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedInteger('idx')->autoIncrement()->comment('고유키');
        $table->unsignedInteger('lecture_idx')->nullable(false)->comment('강의 고유키 참조');
        $table->string('lecture_type_code', 32)->nullable(false)->comment('강의 유형 참조');
        $table->unsignedSmallInteger('limit')->default(0)->nullable(false)->comment('수강 인원 제한');
        $table->enum('learning_date_type', ['years', 'months', 'weeks', 'days'])->default('months')->nullable(false)->comment('학습 기간 날짜 유형');
        $table->unsignedTinyInteger('learning_time')->default(0)->nullable(false)->comment('학습 기간');
        $table->enum('review_date_type', ['years', 'months', 'weeks', 'days'])->default('months')->nullable(false)->comment('복습 기간 날짜 유형');
        $table->unsignedTinyInteger('review_time')->default(0)->nullable(false)->comment('복습 기간');

        $table->foreign('lecture_idx')->on('lectures')->references('idx')->cascadeOnUpdate();
        $table->foreign('lecture_type_code')->on('lecture_types')->references('code')->cascadeOnUpdate();
    }

}
