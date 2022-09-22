<?php

namespace Database\Seeders;

use App\Models\Site\BannerTypesModel;
use Illuminate\Database\Seeder;

class BannerTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->store('lecture_index_ncs', '강의 메인 NCS 배너');
        $this->store('lecture_index_semiconductor', '강의 메인 반도체 배너');
        $this->store('lecture_index_it', '강의 메인 IT 배너');
        $this->store('main', '메인 배너');
    }

    private function store(string $code, string $name)
    {
        BannerTypesModel::create([
            'code' => $code,
            'name' => $name,
        ]);
    }
}
