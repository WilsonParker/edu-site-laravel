<?php

use Illuminate\Database\Schema\Blueprint;

class CreatePopUp extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'pop_up';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedInteger('idx')->autoIncrement()->comment('고유키');
        $table->string('popup_type_code')->nullable(false)->comment('popup_type 참조');
        $table->enum('type', ['popup', 'layer'])->nullable(false)->default('popup')->comment('타입');
        $table->string('name', 64)->nullable(false)->comment('이름');
        $table->text('content')->nullable(false)->comment('내용');
        $table->timestamp('start')->nullable(false)->useCurrent()->comment('팝업 시작일');
        $table->timestamp('end')->nullable(false)->comment('팝업 종료일');
        $table->boolean('is_public')->nullable(false)->default(true)->comment('공개 여부');
        $table->unsignedSmallInteger('top')->nullable(false)->default(0)->comment('팝업창 위치 top');
        $table->unsignedSmallInteger('left')->nullable(false)->default(0)->comment('팝업창 위치 left');
        $table->unsignedSmallInteger('width')->nullable(false)->default(0)->comment('팝업창 크기 가로');
        $table->unsignedSmallInteger('height')->nullable(false)->default(0)->comment('팝업창 크기 세로');
        $table->boolean('scroll')->nullable(false)->default(false)->comment('팝업창 스크롤 여부');

        $table->foreign('popup_type_code')->on('pop_up_types')->references('code')->cascadeOnUpdate()->cascadeOnDelete();
    }
}
