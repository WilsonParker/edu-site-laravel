<?php


namespace App\Models\Permissions;


use App\Models\Common\BaseCodeModel;

class AdminPermissionTemplatesModel extends BaseCodeModel
{
    protected $table = 'admin_permission_templates';

    public function permissions(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(AdminPermissionsModel::class, AdminPermissionTemplatePivotModel::class);
    }
}
