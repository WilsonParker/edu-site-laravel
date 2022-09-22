<?php


namespace App\Models\Permissions;


use App\Models\Common\BaseCodeModel;

class AdminPermissionsModel extends BaseCodeModel
{
    protected $table = 'admin_permissions';

    public function permissionTemplates(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        return $this->hasManyThrough(AdminPermissionTemplatesModel::class, AdminPermissionTemplatePivotModel::class);
    }
}
