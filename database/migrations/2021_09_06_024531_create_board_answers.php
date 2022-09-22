<?php

use Illuminate\Database\Schema\Blueprint;

class CreateBoardAnswers extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'board_answers';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedInteger('idx')->autoIncrement()->comment('고유키');
        $table->unsignedInteger('board_idx')->unique()->nullable(false)->comment('게시판 고유키 참조 (1개의 답변만 가능)');
        $table->unsignedInteger('member_idx')->nullable(false)->comment('회원 고유키 참조');
        $table->text('contents')->nullable(true)->comment('내용');

        $table->foreign('board_idx')->on('boards')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();
        $table->foreign('member_idx')->on('members')->references('idx')->cascadeOnUpdate();
    }

}
