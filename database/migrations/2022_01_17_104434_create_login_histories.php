<?php

use Illuminate\Database\Schema\Blueprint;

class CreateLoginHistories extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'login_histories';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedInteger('idx')->autoIncrement()->comment('고유키');
        $table->unsignedInteger('member_idx')->nullable(false)->comment('Members 참조');
        $table->string('agent', 256)->nullable(false)->comment('agent');
        $table->string('browser', 32)->nullable(true)->comment('브라우저');
        $table->string('browser_version', 32)->nullable(true)->comment('브라우저 버전');
        $table->string('platform', 32)->nullable(true)->comment('platform');
        $table->string('platform_version', 32)->nullable(true)->comment('platform 버전');
        $table->string('device', 32)->nullable(true)->comment('device');
        $table->string('ip', 32)->nullable(false)->comment('ip');

        $table->foreign('member_idx')->on('members')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();
    }
}
