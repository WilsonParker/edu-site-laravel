<?php

namespace Database\Seeders;

use App\Models\Lectures\NBCTypesModel;
use Illuminate\Database\Seeder;

class NBCTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->store('employment_crisis_area', '고용위기지역', '');
        $this->store('special_employment_industry', '특별고용지원업종', '');
        $this->store('obstacle', '장애인', '');
        $this->store('basic_living_recipient', '기초생활수급자', '');
        $this->store('single_parent', '한부모가족지원대상자', '');
        $this->store('north_korean_defector', '북한이탈주민', '');
        $this->store('working_child_subsidy', '근로자녀장려금 수급자', '');
        $this->store('employ_package_first', '취성패/국취제 1유형(고용보험납부)', '');
        $this->store('employ_package_second', '취성패/국취제 2유형(고용보험납부)', '');
        $this->store('full_support', '전액지원과정', '');
        $this->store('covid', '코로나학번', '');
    }

    private function store(string $code, string $name, string $description)
    {
        NBCTypesModel::create([
            'code' => $code,
            'name' => $name,
            'description' => $description,
        ]);
    }
}
