<?php

namespace Database\Seeders;

use App\Models\Boards\BoardCategoriesModel;
use App\Models\Boards\BoardCategoryTypePivotModel;
use App\Models\Boards\BoardTypesModel;
use Illuminate\Database\Seeder;

class BoardCategoryTypePivotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->store('notice', 'notice');
        $this->store('notice', 'event');
        $this->store('notice', 'ncs_info');
        $this->store('notice', 'guide');
        $this->store('notice', 'ncs_faq');
        $this->store('notice', 'others');
        $this->store('faq', 'faq_join');
        $this->store('faq', 'faq_lecture');
        $this->store('faq', 'faq_hrd');
        $this->store('faq', 'faq_exam');
        $this->store('faq', 'faq_ncs');
        $this->store('faq', 'faq_certificate');
        $this->store('faq', 'faq_pay');
        $this->store('faq', 'faq_others');
    }

    private function store(string $board_type_code, string $board_category_code)
    {
        BoardCategoryTypePivotModel::create([
            'board_type_code' => $board_type_code,
            'board_category_code' => $board_category_code,
        ]);
    }
}
