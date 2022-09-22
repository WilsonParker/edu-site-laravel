<?php

use Illuminate\Database\Schema\Blueprint;

class CreateLectureTrialInformation  extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'lecture_trial_information';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedInteger('idx')->autoIncrement()->comment('고유키');
        $table->unsignedInteger('lecture_idx')->nullable(false)->comment('Lectures 참조');
        $table->string('trial_code', 256)->nullable(false)->comment('심사코드');
        $table->boolean('is_input')->nullable(false)->comment('입과 신청 여부');
        $table->timestamp('input_date')->nullable(false)->comment('입과 신청 일');
        $table->boolean('is_completion')->nullable(false)->comment('수료 신고 여부');
        $table->timestamp('completion_date')->nullable(false)->comment('수료 신고 일');
        $table->timestamp('start')->nullable(false)->comment('심사 시작 일');
        $table->timestamp('end')->nullable(false)->comment('심사 종료 일');

        $table->foreign('lecture_idx')->on('lectures')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();
    }
}
