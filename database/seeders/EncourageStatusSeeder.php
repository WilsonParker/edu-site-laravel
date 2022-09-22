<?php

namespace Database\Seeders;

use App\Models\Lectures\ExamStatusModel;
use App\Models\Sms\EncourageStatusModel;
use Illuminate\Database\Seeder;

class EncourageStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->store('progress', '진도','');
        $this->store('evaluation', '진행단계평가 미제출','');
        $this->store('no_test', '시험미제출','');
        $this->store('no_task', '과제미제출','');
        $this->store('complete', '수료완료','');
    }

    private function store(string $code, string $name, string $description)
    {
        EncourageStatusModel::create([
            'code' => $code,
            'name' => $name,
            'description' => $description,
        ]);
    }
}
