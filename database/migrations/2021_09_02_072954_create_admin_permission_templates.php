<?php

use Illuminate\Database\Schema\Blueprint;

class CreateAdminPermissionTemplates extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'admin_permission_templates';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->string('code',64)->primary()->comment('고유키');
        $table->string('name', 64)->nullable(false)->comment('권한 탬플릿 이름');
        $table->string('description', 512)->nullable(true)->comment('권한 탬플릿 설명');
    }
}
