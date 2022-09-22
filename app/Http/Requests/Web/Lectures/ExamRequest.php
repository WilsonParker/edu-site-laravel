<?php

namespace App\Http\Requests\Web\Lectures;

use LaravelSupports\Libraries\Supports\Http\Requests\Common\BaseFormRequest;

class ExamRequest extends BaseFormRequest
{
    protected array $messages = [
        'page.numeric' => '숫자만 입력 가능 합니다.',
    ];

    protected string $prefix = 'lectures/exams';

    protected function init()
    {
        $this->appendGet([
            'page' => [
                'nullable',
                'numeric',
            ],
        ], '(middle|final)/\d', null, true);

        $this->appendPost([
            'page' => [
                'nullable',
                'numeric',
            ],
            'answer' => [
                'nullable',
                'string',
            ],
        ], '(middle|final)/\d', null, true);

        $this->appendPost([
            'page' => [
                'nullable',
                'numeric',
            ],
            'answer' => [
                'nullable',
                'string',
            ],
            'file' => [
                'nullable',
                'file',
            ],
        ], 'task/*', null, true);

    }
}
