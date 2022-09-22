<?php

namespace App\Http\Requests\Web\Members;

use LaravelSupports\Libraries\Supports\Http\Requests\Common\BaseFormRequest;

class LectureRequest extends BaseFormRequest
{
    protected array $messages = [
        'number.required' => '차시 정보는 필수 입니다',
        'number.numeric' => '차시 정보는 숫자만 가능합니다',
        'time.required' => '수강 시간 정보는 필수 입니다',
        'time.numeric' => '수강 시간 정보는 숫자만 가능합니다',
    ];

    protected string $prefix = 'members';
    protected bool $isFailedRedirect = false;

    protected function init()
    {
        $this->appendGet([
            'number' => [
                'required',
                'numeric'
            ],
            'time' => [
                'required',
                'numeric',
            ],
        ]);
    }
}
