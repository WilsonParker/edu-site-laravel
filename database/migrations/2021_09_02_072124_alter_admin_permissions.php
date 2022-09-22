<?php

use Illuminate\Database\Schema\Blueprint;

class AlterAdminPermissions extends \LaravelSupports\Libraries\Supports\Databases\Migrations\AlterMigration
{
    protected string $table = 'admin_permissions';

    function defaultUpTemplate(Blueprint $table)
    {
        $table->foreign('parent')->on('admin_permissions')->references('code')->cascadeOnUpdate();
    }

    protected function defaultDownTemplate(Blueprint $table)
    {
        $table->dropForeign('admin_permissions_parent_foreign');
    }
}
