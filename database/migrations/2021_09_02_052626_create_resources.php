<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResources extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'resources';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedBigInteger('idx')->autoIncrement()->comment('고유키');
        $table->unsignedInteger('resourceable_id')->nullable(true)->comment('연결된 고유키');
        $table->string('resourceable_type', 64)->nullable(true)->comment('상위 모델 클래스');
        $table->string('origin_name', 256)->nullable(false)->comment('기존 이름');
        $table->string('name', 256)->nullable(false)->comment('이름');
        $table->string('path', 512)->nullable(false)->comment('경로');
        $table->string('extension', 16)->nullable(false)->comment('확장자');
    }

}
