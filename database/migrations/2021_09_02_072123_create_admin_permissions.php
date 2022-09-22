<?php

use Illuminate\Database\Schema\Blueprint;

class CreateAdminPermissions extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'admin_permissions';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->string('code', 64)->primary()->comment('고유키');
        $table->string('parent', 64)->nullable(true)->comment('권한 고유키 참조');
        $table->string('name', 64)->nullable(false)->comment('권한 이름');
        $table->string('description', 512)->nullable(true)->comment('권한 설명');
    }

}
