<?php

namespace Database\Seeders;

use App\Models\Boards\BoardCategoriesModel;
use App\Models\Boards\BoardTypesModel;
use Illuminate\Database\Seeder;

class BoardTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->store('faq', '자주하는질문');
        $this->store('notice', '공지사항');

    }

    private function store(string $code, string $name)
    {
        BoardTypesModel::create([
            'code' => $code,
            'name' => $name,
        ]);
    }
}
