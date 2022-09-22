<?php

namespace Database\Seeders;

use App\Models\Payments\PaymentMethodsModel;
use Illuminate\Database\Seeder;

class PaymentMethodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->store('card', '카드' ,'');
        $this->store('vbank', '가상계좌', '');
        $this->store('trans', '계좌이체', '');
        $this->store('coupon', '쿠폰', '');
    }

    private function store(string $code, string $name, string $description )
    {
        PaymentMethodsModel::create([
            'code' => $code,
            'name' => $name,
            'description' => $description,
        ]);
    }
}
