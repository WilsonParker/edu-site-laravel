<?php

namespace Database\Seeders;

use App\Models\Permissions\AdminPermissionTemplatePivotModel;
use Illuminate\Database\Seeder;

class AdminPermissionTemplatePivotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->store('super', 'members');
        $this->store('super', 'lectures');
    }

    private function store(string $template, string $permission)
    {
        AdminPermissionTemplatePivotModel::create([
            'admin_permission_template_code' => $template,
            'admin_permission_code' => $permission,
        ]);
    }
}
