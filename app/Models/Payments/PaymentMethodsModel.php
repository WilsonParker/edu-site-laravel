<?php


namespace App\Models\Payments;


use App\Models\Common\BaseCodeModel;
use App\Models\Lectures\MemberLectureCardinalNumbersModel;

class PaymentMethodsModel extends BaseCodeModel
{
    protected $table = 'payment_methods';

    public function payment(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(PaymentsModel::class);
    }
}
