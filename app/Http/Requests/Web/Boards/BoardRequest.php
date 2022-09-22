<?php

namespace App\Http\Requests\Web\Boards;

use App\Models\Boards\BoardCategoriesModel;
use App\Models\Boards\BoardTypesModel;
use LaravelSupports\Libraries\Supports\Http\Requests\Common\BaseFormRequest;

class BoardRequest extends BaseFormRequest
{
    protected array $messages = [
        'code.exists' => '존재하지 않는 페이지 입니다.',
    ];

    protected string $prefix = 'board';
    protected $redirect = '/board';

    public function rules(): array
    {
        $rules = match ($this->path()) {
            $this->prefix . "" => [
                'code' => 'nullable|exists:' . BoardCategoriesModel::class,
                'type' => 'nullable|exists:' . BoardTypesModel::class . ',code',
            ],
            default => [],
        };
        return $rules;
    }

}
