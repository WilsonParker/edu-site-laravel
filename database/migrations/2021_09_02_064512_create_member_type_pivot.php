<?php

use Illuminate\Database\Schema\Blueprint;

class CreateMemberTypePivot extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'member_type_pivot';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedInteger('idx')->autoIncrement()->comment('고유키');
        $table->unsignedInteger('member_idx')->nullable(false)->comment('회원 참조');
        $table->string('member_type_code',32)->nullable(false)->comment('회원 유형 참조');

        $table->foreign('member_idx')->on('members')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();
        $table->foreign('member_type_code')->on('member_types')->references('code')->cascadeOnUpdate()->cascadeOnDelete();
    }

}
