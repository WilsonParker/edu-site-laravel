<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLectureProgramNBC extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'lecture_program_nbc';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedInteger('idx')->autoIncrement()->comment('고유키');
        $table->unsignedInteger('lecture_program_idx')->nullable(false)->comment('강의 운영 과정 참조');
        $table->unsignedSmallInteger('year')->nullable(false)->comment('년도');
        $table->unsignedInteger('number')->nullable(false)->comment('기수 (HRD 회차 정보)');
        $table->enum('status', ['ready', 'receipt', 'progress', 'end'])->default('ready')->nullable(false)->comment('상태 (READY: 대기, RECEIPT: 접수, PROGRESS: 진행 END:종료)');
        $table->timestamp('subscription_start')->nullable(true)->comment('수강 신청 시작');
        $table->timestamp('subscription_end')->nullable(true)->comment('수강 신청 시작');
        $table->timestamp('study_start')->nullable(true)->comment('수강 신청 시작');
        $table->timestamp('study_end')->nullable(true)->comment('수강 신청 시작');

        $table->foreign('lecture_program_idx')->on('lecture_program')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();
    }

}
