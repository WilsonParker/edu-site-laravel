<?php

use Illuminate\Database\Schema\Blueprint;

class CreateMemberPermissionTemplatePivot extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'member_permission_template_pivot';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedInteger('idx')->autoIncrement()->comment('고유키');
        $table->unsignedInteger('member_idx')->unique()->nullable(false)->comment('회원 고유키 참조');
        $table->string('admin_permission_template_code', 64)->nullable(false)->comment('권한 탬플릿 고유키 참조');

        $table->foreign('member_idx')->on('members')->references('idx')->cascadeOnUpdate();
        $table->foreign('admin_permission_template_code', 'member_permission_template_pivot_foreign')->on('admin_permission_templates')->references('code')->cascadeOnUpdate()->cascadeOnDelete();

        $table->unique(['member_idx', 'admin_permission_template_code'], 'member_permission_template_pivot_idx_code_unique');
    }

}
