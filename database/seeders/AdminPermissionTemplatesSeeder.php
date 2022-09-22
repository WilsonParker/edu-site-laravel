<?php

namespace Database\Seeders;

use App\Models\Permissions\AdminPermissionTemplatesModel;
use Illuminate\Database\Seeder;

class AdminPermissionTemplatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->store('super', '최고 관리자', '');
        $this->store('manager', '매니저', '');
        $this->store('tutor', '강사', '');
    }

    private function store(string $code, string $name, string $description)
    {
        return AdminPermissionTemplatesModel::create([
            'code' => $code,
            'name' => $name,
            'description' => $description,
        ]);
    }
}
