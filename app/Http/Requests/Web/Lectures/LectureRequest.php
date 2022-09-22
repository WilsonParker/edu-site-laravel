<?php

namespace App\Http\Requests\Web\Lectures;

use App\Models\Lectures\LectureCategoriesModel;
use Illuminate\Validation\Rule;
use LaravelSupports\Libraries\Supports\Http\Requests\Common\BaseFormRequest;

class LectureRequest extends BaseFormRequest
{
    protected array $messages = [
        'type.exists' => '존재하지 않는 카테고리 입니다.',
        'code.exists' => '존재하지 않는 카테고리 입니다.',
        'keyword.required' => '검색어를 입력해주세요.',
    ];

    protected string $prefix = 'lectures';
    protected $redirect = '/lectures';

    protected function init()
    {
        $this->appendGet([
            'type' => [
                'nullable',
                Rule::in(['ncs', 'it', 'semiconductor']),
            ],
            'code' => [
                'nullable',
                'exists:' . LectureCategoriesModel::class,
            ],
        ]);

        $this->appendGet([
            'type' => [
                'nullable',
                Rule::in(['ncs', 'it', 'semiconductor']),
            ],
            'code' => [
                'nullable',
                'exists:' . LectureCategoriesModel::class,
            ],
            'keyword' => [
                'required',
            ],
        ], 'search');
    }
}
