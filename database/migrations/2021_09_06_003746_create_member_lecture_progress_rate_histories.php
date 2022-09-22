<?php

use Illuminate\Database\Schema\Blueprint;

/**
 * 강의 진도율 기록
 * @author  dev9163
 * @added   2021/09/17
 * @updated 2021/09/17
 */
class CreateMemberLectureProgressRateHistories extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'member_lecture_progress_rate_histories';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedBigInteger('idx')->autoIncrement()->comment('고유키');
        $table->unsignedInteger('member_lecture_program_idx')->nullable(false)->comment('회원 강의 운영 과정 참조');
        $table->unsignedInteger('lecture_class_idx')->nullable(false)->comment('강의 수업차시 고유키 참조');
        // $table->unsignedInteger('member_idx')->nullable(false)->comment('회원 고유키 참조');
        $table->string('access_ip',16)->nullable(false)->comment('접근 ip');
        $table->timestamp('start')->nullable(false)->comment('시작시간');
        $table->timestamp('end')->nullable(true)->comment('종료시간');

        $table->foreign('member_lecture_program_idx', 'member_lecture_progress_rate_histories_program_foreign')->on('member_lecture_program')->references('idx')->cascadeOnUpdate();
        $table->foreign('lecture_class_idx')->on('lecture_classes')->references('idx')->cascadeOnUpdate();
        // $table->foreign('member_idx')->on('members')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();
    }

}
