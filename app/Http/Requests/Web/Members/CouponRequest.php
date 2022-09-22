<?php

namespace App\Http\Requests\Web\Members;

use App\Models\Coupons\CouponsModel;
use LaravelSupports\Libraries\Supports\Http\Requests\Common\BaseFormRequest;

class CouponRequest extends BaseFormRequest
{
    protected array $messages = [
        'code.required' => '쿠폰 코드를 입력해주세요.',
        'code.exists' => '해당 쿠폰 코드가 존재하지 않습니다.',
    ];

    protected string $prefix = 'members/coupons';

    protected function init()
    {
        $this->appendPost([
            'code' => [
                'required',
                'exists:' . CouponsModel::class
            ],
        ], 'use');
    }

}
