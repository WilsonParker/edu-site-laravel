<?php

namespace Database\Seeders;

use App\Models\Lectures\ExamStatusModel;
use Illuminate\Database\Seeder;

class ExamStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->store('none', '미응시', '');
        $this->store('waiting_for_grading', '응시 (채점 대기중)', '');
        $this->store('complete_grading', '응시 (채점 완료)', '');
    }

    private function store(string $code, string $name, string $description)
    {
        ExamStatusModel::create([
            'code' => $code,
            'name' => $name,
            'description' => $description,
        ]);
    }
}
