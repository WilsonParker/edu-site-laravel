<?php

namespace Database\Seeders;

use App\Models\Lectures\ExamStatusModel;
use App\Models\Lectures\LectureSurveysModel;
use App\Models\Lectures\LectureSurveyTypeModel;
use Illuminate\Database\Seeder;

class LectureSurveyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->store('content', '교육내용', '');
        $this->store('tutor', '교강사(튜터),', '');
        $this->store('operation', '교육운영', '');
        $this->store('lms', 'LMS', '');
        $this->store('support', '학습지원도구', '');
        $this->store('etc', '기타', '');
    }

    private function store(string $code, string $name, string $description)
    {
        LectureSurveyTypeModel::create([
            'code' => $code,
            'name' => $name,
            'description' => $description,
        ]);
    }
}
