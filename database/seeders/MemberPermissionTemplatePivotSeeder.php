<?php

namespace Database\Seeders;

use App\Models\Permissions\MemberPermissionTemplatePivotModel;
use Illuminate\Database\Seeder;

class MemberPermissionTemplatePivotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->store('1', 'super');
        $this->store('2', 'manager');
    }

    private function store(int $memberIdx, string $code)
    {
        MemberPermissionTemplatePivotModel::create([
            'member_idx' => $memberIdx,
            'admin_permission_template_code' => $code,
        ]);
    }
}
