<?php

use Illuminate\Database\Schema\Blueprint;

class CreateTutorInformation extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'tutor_information';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedInteger('idx')->autoIncrement()->comment('고유키');
        $table->unsignedInteger('member_idx')->nullable(false)->comment('회원 고유키 참조');
        $table->unsignedInteger('correcting_cost')->nullable(false)->comment('첨삭비용');
        $table->text('career')->nullable(false)->comment('경력사항');
        $table->text('introduction')->nullable(false)->comment('강사소개');

        $table->foreign('member_idx')->on('members')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();
    }

}
