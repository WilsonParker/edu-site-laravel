<?php

namespace App\Http\Requests\Web\Qna;

use LaravelSupports\Libraries\Supports\Http\Requests\Common\BaseFormRequest;

class QnaRequest extends BaseFormRequest
{
    protected array $messages = [
        'title.required' => '제목을 입력해주세요.',
        'title.max' => '제목은 64자리 까지만 가능합니다.',
        'contents.required' => '내용을 입력해주세요.',
    ];

    protected string $prefix = 'qna';
    protected $redirect = '/qna';

    public function rules(): array
    {
        return match ($this->method()) {
            'POST','PUT' => [
                'title' => [
                    'required', 'string', 'max:64'
                ],
                'contents' => [
                    'required', 'string'
                ],
                'file' => [
                    'nullable', 'file', 'max:65536'
                ],
            ],
            default => [],
        };
    }

}
