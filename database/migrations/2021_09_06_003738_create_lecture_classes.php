<?php

use Illuminate\Database\Schema\Blueprint;

class CreateLectureClasses extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'lecture_classes';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedInteger('idx')->autoIncrement()->comment('고유키');
        $table->unsignedInteger('lecture_idx')->nullable(false)->comment('강의 고유키 참조');
        $table->unsignedTinyInteger('number')->default(1)->nullable(false)->comment('차시 번호');
        $table->string('title', 128)->nullable(false)->comment('제목');
        $table->unsignedTinyInteger('page')->nullable(false)->comment('페이지 수');
        $table->unsignedTinyInteger('time')->nullable(false)->comment('시간');
        $table->string('link', 256)->nullable(false)->comment('링크');
        $table->string('mobile_link', 256)->nullable(false)->comment('모바일 링크');

        $table->foreign('lecture_idx')->on('lectures')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();
    }

}
