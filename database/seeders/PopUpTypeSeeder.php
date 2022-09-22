<?php

namespace Database\Seeders;

use App\Models\Site\PopUpTypesModel;
use Illuminate\Database\Seeder;

class PopUpTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->store('main', '메인 페이지', '');
        $this->store('mypage', '내 정보 페이지', '');
    }

    private function store(string $code, string $name, string $description)
    {
        PopUpTypesModel::create([
            'code' => $code,
            'name' => $name,
            'description' => $description,
        ]);
    }
}
