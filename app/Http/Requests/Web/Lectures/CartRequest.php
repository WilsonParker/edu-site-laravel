<?php

namespace App\Http\Requests\Web\Lectures;

use App\Models\Lectures\CartsModel;
use App\Models\Lectures\LecturesModel;
use LaravelSupports\Libraries\Supports\Http\Requests\Common\BaseFormRequest;

class CartRequest extends BaseFormRequest
{
    protected array $messages = [
        'lecture.required' => '강의 정보는 필수 입니다.',
        'lecture.exists' => '존재하지 않는 강의 입니다.',
    ];

    protected string $prefix = 'members';

    protected function init()
    {
        $this->appendPost([
            'lecture' => [
                'required',
                'exists:' . LecturesModel::class . ',idx'
            ]
        ]);
        $this->appendDelete([
            'carts' => [
                'nullable',
                'array',
                'exists:' . CartsModel::class . ',idx'
            ]
        ]);
    }

}
