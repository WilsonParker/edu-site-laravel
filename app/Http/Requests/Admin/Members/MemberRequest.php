<?php

namespace App\Http\Requests\Admin\Members;

use LaravelSupports\Libraries\Supports\Http\Requests\Common\BaseFormRequest;

class MemberRequest extends BaseFormRequest
{
    protected array $messages = [
        'id.required' => '회원 id 값은 필수 입니다.',
        'id.exists' => '회원이 존재하지 않습니다.',
    ];
    private string $prefix = 'member';

    public function rules(): array
    {
        $rules = match ($this->path()) {
            $this->prefix . "/modal/select" => [
                'id' => 'required|exists:' . MemberModel::class,
            ],
            default => [],
        };
        return $rules;
    }

}
