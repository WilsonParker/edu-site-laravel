<?php

use Illuminate\Database\Schema\Blueprint;

/**
 * 강의 재생 기록
 * @author  dev9163
 * @added   2021/09/17
 * @updated 2021/09/17
 * @updated 2021/11/17
 */
class CreateMemberLectureProgressRecords extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'member_lecture_progress_records';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedInteger('idx')->autoIncrement()->comment('고유키');
        $table->unsignedInteger('member_lecture_program_idx')->nullable(false)->comment('회원 강의 운영 과정 참조');
        $table->unsignedInteger('lecture_class_idx')->nullable(false)->comment('강의 수업차시 고유키 참조');
        $table->unsignedInteger('member_idx')->nullable(false)->comment('회원 고유키 참조');
        $table->unsignedSmallInteger('end_page')->nullable(false)->comment('수강 종료 페이지 (이어보는 페이지)');
        $table->unsignedInteger('time')->nullable(false)->comment('진행 시간');

        $table->foreign('member_lecture_program_idx', 'member_lecture_progress_records_lecture_program_idx_foreign')->on('member_lecture_program')->references('idx')->cascadeOnUpdate();
        $table->foreign('lecture_class_idx')->on('lecture_classes')->references('idx')->cascadeOnUpdate();
        $table->foreign('member_idx')->on('members')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();

        $table->unique(['member_idx', 'member_lecture_program_idx', 'lecture_class_idx'], 'member_lecture_progress_rates_unique');
    }

}
