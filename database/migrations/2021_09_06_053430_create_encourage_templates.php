<?php

use Illuminate\Database\Schema\Blueprint;

class CreateEncourageTemplates extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'encourage_templates';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->string('code', 32)->comment('고유키');
        $table->string('encourage_status_code', 32)->nullable(false)->comment('시험 상태 고유키 참조');
        $table->unsignedTinyInteger('progress_rate')->nullable(false)->default(0)->comment('진도율');
        $table->unsignedTinyInteger('after_day')->nullable(false)->default(0)->comment('학습시작 후 일 수');
        $table->unsignedTinyInteger('day_rate')->nullable(false)->default(0)->comment('학습시작 후 퍼센트');
        $table->text('contents')->nullable(false)->comment('메시지 내용');
        $table->unsignedTinyInteger('send_time_hour')->nullable(false)->default(0)->comment('발송할 시간');

        $table->foreign('encourage_status_code')->on('encourage_status')->references('code')->cascadeOnUpdate();
    }

}
