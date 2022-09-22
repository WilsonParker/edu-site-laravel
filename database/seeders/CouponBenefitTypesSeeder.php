<?php

namespace Database\Seeders;

use App\Models\Coupons\CouponBenefitTypesModel;
use Illuminate\Database\Seeder;

class CouponBenefitTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->store('provide_lecture', '강의 제공', '');
        $this->store('price_discount', '가격 할인', '가격을 ? 만큼 할인 합니다');
        $this->store('price_percent_discount', '퍼센트 가격 할인', '가격을 ?% 만큼 (최대 ?) 할인 합니다');
    }

    private function store(string $code, string $name, string $description)
    {
        CouponBenefitTypesModel::create([
            'code' => $code,
            'name' => $name,
            'description' => $description,
        ]);
    }
}
