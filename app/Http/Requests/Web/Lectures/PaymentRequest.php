<?php

namespace App\Http\Requests\Web\Lectures;

use App\Models\Lectures\CartsModel;
use App\Models\Lectures\LectureProgramModel;
use App\Models\Payments\PaymentMethodsModel;
use App\Models\Payments\PaymentsModel;
use LaravelSupports\Libraries\Supports\Http\Requests\Common\BaseFormRequest;

class PaymentRequest extends BaseFormRequest
{
    protected array $messages = [
        'idx.required' => '결제 정보가 존재하지 않습니다.',
        'idx.exists' => '결제 정보가 존재하지 않습니다.',
        'method.exists' => '결제 방식이 존재하지 않습니다.',
        'merchant_uid.exists' => '올바른 요청이 아닙니다.',
    ];

    protected string $prefix = 'lectures/payments';
    protected bool $isFailedRedirect = false;

    protected function init()
    {
        $this->appendGet([
            'idx' => [
                'required',
                'exists:' . LectureProgramModel::class
            ],
        ], 'normal');

        $this->appendGet([
            'idx' => [
                'required',
                'array',
                'exists:' . CartsModel::class
            ],
        ], 'cart', true);

        $this->appendPost([
            'idx' => [
                'required',
                'array',
                'exists:' . LectureProgramModel::class
            ],
            'method' => [
                'required',
                'exists:' . PaymentMethodsModel::class . ',code',
            ]
        ], 'ready');

        $this->appendPost([
            'request_id' => [
                'required',
                'exists:' . PaymentsModel::class,
            ],
            'unique_id' => ['required',],
            'name' => ['required',],
            'price' => ['required',],
            'method' => [
                'required',
                'exists:' . PaymentMethodsModel::class . ',code',
            ],
            'pg_provider' => ['required',],
            'pg_unique_id' => ['required',],
            'receipt_url' => ['required',],
            'buyer_address' => ['required',],
            'buyer_email' => ['required',],
            'buyer_name' => ['required',],
            'buyer_postcode' => ['required',],
            'buyer_contact' => ['required',],
            'bank_name' => ['nullable',],
            'card_approval' => ['nullable',],
            'card_name' => ['nullable',],
            'card_number' => ['nullable',],
            'card_quota' => ['nullable',],
            'vbank_date' => ['nullable',],
            'vbank_holder' => ['nullable',],
            'vbank_name' => ['nullable',],
            'vbank_num' => ['nullable',],
        ], 'paid', false);

        $this->appendPost([
            'imp_uid' => [
                'required',
            ],
            'merchant_uid' => [
                'required',
                'exists:' . PaymentsModel::class . ',request_id',
            ],
            'status' => [
                'required',
            ],
        ], 'hooks', false);

    }

}
