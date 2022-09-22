<?php

use Illuminate\Database\Schema\Blueprint;

class CreateLectureBooks extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'lecture_books';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedInteger('idx')->autoIncrement()->comment('고유키');
        $table->unsignedInteger('lecture_idx')->nullable(false)->comment('Lectures 참조');
        $table->string('name', 128)->nullable(false)->comment('책 이름');
        $table->string('price', 8)->nullable(false)->comment('금액');
        $table->string('url', 256)->nullable(false)->comment('주소');
        $table->unsignedBigInteger('image_idx')->nullable(true)->comment('이미지 (리소스 참조)');

        $table->foreign('lecture_idx')->on('lectures')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();
        $table->foreign('image_idx')->on('resources')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();
    }
}
