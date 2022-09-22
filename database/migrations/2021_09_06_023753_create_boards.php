<?php

use Illuminate\Database\Schema\Blueprint;

class CreateBoards extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'boards';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedInteger('idx')->autoIncrement()->comment('고유키');
        $table->string('board_category_code', 32)->nullable(false)->comment('카테고리 고유키 참조');
        $table->unsignedInteger('member_idx')->nullable(false)->comment('회원 고유키 참조');
        $table->string('title', 128)->nullable(false)->comment('제목');
        $table->mediumText('contents')->nullable(false)->comment('내용');
        $table->unsignedInteger('views')->default(0)->nullable(false)->comment('조회수');
        $table->boolean('is_notice')->default(false)->nullable(false)->comment('공지 여부');
        $table->boolean('is_public')->default(true)->nullable(false)->comment('공개 여부');
        $table->enum('step',['ready','continue','end'])->nullable(true)->comment('진행 단계');
        $table->unsignedBigInteger('file_idx')->nullable(true)->comment('첨부파일');

        $table->foreign('board_category_code')->on('board_categories')->references('code')->cascadeOnUpdate();
        $table->foreign('member_idx')->on('members')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();
        $table->foreign('file_idx')->on('resources')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();

    }
}
