<?php

namespace Database\Seeders;

use App\Models\Permissions\AdminPermissionsModel;
use Illuminate\Database\Seeder;

class AdminPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->parentStore('members', '회원 관리', '', [
            $this->buildData('index', '회원 조회'),
            $this->buildData('store', '회원 생성'),
            $this->buildData('update', '회원 수정'),
            $this->buildData('delete', '회원 삭제'),
        ]);

        $this->parentStore('lectures', '강의 관리', '', [
            $this->buildData('index', '강의 조회'),
            $this->buildData('store', '강의 생성'),
            $this->buildData('update', '강의 수정'),
            $this->buildData('delete', '강의 삭제'),
        ]);
    }

    private function parentStore(string $code, string $name, string $description, $children)
    {
        $model = $this->store($code, null, $name, $description);
        collect($children)->each(fn($child) => $this->store($model->code . '_' . $child['code'], $model->code, $child['name'], $child['description']));
    }

    private function buildData(string $code, string $name, string $description = ''): array
    {
        return [
            'code' => $code,
            'name' => $name,
            'description' => $description,
        ];
    }

    private function store(string $code, ?string $parent, string $name, string $description)
    {
        return AdminPermissionsModel::create([
            'code' => $code,
            'parent' => $parent,
            'name' => $name,
            'description' => $description,
        ]);
    }
}
