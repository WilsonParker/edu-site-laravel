<?php

use Illuminate\Database\Schema\Blueprint;

class CreateAdminPermissionTemplatePivot extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'admin_permission_template_pivot';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedInteger('idx')->autoIncrement()->comment('고유키');
        $table->string('admin_permission_template_code', 64)->nullable(false)->comment('권한 고유키 참조');
        $table->string('admin_permission_code', 64)->nullable(false)->comment('권한 이름');

        $table->foreign('admin_permission_template_code', 'admin_permission_template_pivot_template_code_foreign')->on('admin_permission_templates')->references('code')->cascadeOnUpdate();
        $table->foreign('admin_permission_code')->on('admin_permissions')->references('code')->cascadeOnUpdate()->cascadeOnDelete();

        $table->unique(['admin_permission_template_code', 'admin_permission_code'], 'admin_permission_template_pivot_template_permission_unique');
    }

}
