<?php

namespace Database\Seeders;

use App\Models\Lectures\ExamTypesModel;
use Illuminate\Database\Seeder;

class ExamTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->store('middle', '중간 평가', '');
        $this->store('final', '최종 평가', '');
        $this->store('task', '과제', '');
    }

    private function store(string $code, string $name, string $description)
    {
        ExamTypesModel::create([
            'code' => $code,
            'name' => $name,
            'description' => $description,
        ]);
    }
}
