<?php

namespace App\ViewModels\Web\Lectures;

use App\ViewModels\Common\BaseViewModel;

class PaymentViewModel extends BaseViewModel
{
    protected string $dateFormat = 'Y-m-d';
    public int $total = 0;
    public $member;

    public function buildPaymentInformation(): array
    {
        return [
            'pg' => 'html5_inicis',
            'pay_method' => 'card',
            'merchant_uid' => '',
            'name' => '',
            'amount' => $this->total,
            'buyer_email' => $this->member->memberInformation->email,
            'buyer_name' => $this->member->memberInformation->name,
            'buyer_tel' => $this->member->memberInformation->phone_number,
            'buyer_addr' => $this->member->memberInformation->address,
            'buyer_postcode' => $this->member->memberInformation->zip_code,
        ];
    }
}
