<?php

namespace Database\Seeders;

use App\Models\Lectures\LectureTypesModel;
use Illuminate\Database\Seeder;

class LectureTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->store('test', '테스트', '');
        $this->store('normal', '일반', '');
        $this->store('nbc', '내일배움카드', '');
        $this->store('business', '사업주', '');
    }

    private function store(string $code, string $name, string $description)
    {
        LectureTypesModel::create([
            'code' => $code,
            'name' => $name,
            'description' => $description,
        ]);
    }
}
