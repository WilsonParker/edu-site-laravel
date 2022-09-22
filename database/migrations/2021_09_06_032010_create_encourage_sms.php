<?php

use Illuminate\Database\Schema\Blueprint;

class CreateEncourageSms extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'encourage_sms';

    protected function defaultUpTemplate(Blueprint $table)
    {
        /*$table->unsignedBigInteger('idx')->autoIncrement()->comment('고유키');
        $table->unsignedInteger('lecture_idx')->nullable(false)->comment('강의 고유키 참조');
        $table->string('exam_status_code', 32)->nullable(false)->comment('시험 상태 고유키 참조');
        $table->unsignedTinyInteger('progress_rate')->default(0)->nullable(false)->comment('진도율');
        $table->enum('status', ['ready', 'success', 'failed'])->nullable(false)->comment('발송상태 (준비, 성공, 실패)');
        $table->text('message')->nullable(false)->comment('메시지 내용');
        $table->timestamp('sended_at')->nullable(true)->comment('발송시간');

        $table->foreign('lecture_idx')->on('lectures')->references('idx')->cascadeOnUpdate();
        $table->foreign('exam_status_code')->on('exam_status')->references('code')->cascadeOnUpdate();*/
    }

}
