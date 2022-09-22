<?php

namespace Database\Seeders;

use App\Models\Coupons\CouponConditionTypesModel;
use Illuminate\Database\Seeder;

class CouponConditionTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    }

    private function store(string $code, string $name, string $description)
    {
        CouponConditionTypesModel::create([
            'code' => $code,
            'name' => $name,
            'description' => $description,
        ]);
    }
}
