<?php

namespace App\Http\Requests\Web\Members;

use App\Services\Auth\AuthService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use LaravelSupports\Libraries\Supports\Http\Requests\Common\BaseFormRequest;

class MemberRequest extends BaseFormRequest
{
    protected array $messages = [
        'current_password.current_password' => '비밀번호가 일치하지 않습니다.',
        'new_password.required' => '변경할 비밀번호를 입력해주세요.',
        'new_password.confirmed' => '변경할 비밀번호가 일치하지 않습니다.',
        'new_password.min' => '비밀번호는 최소 8자리 이상 입력하셔야 합니다.',
    ];

    protected string $prefix = 'members';

    protected function init()
    {
        $this->validatorCallback = function (\Illuminate\Validation\Validator $validator) {
            $validated = $validator->validated();
            if(Arr::exists($validated, 'current_password') && !Auth::guard()->isValidateCredentials(AuthService::getAuthMember(), $validated['current_password'])) {
                $validator->errors()->add('current_password', '비밀번호가 일치하지 않습니다.');
            }
        };

        $this->appendPut([
            'current_password' => ['required'],
            'email' => ['required', 'email'],
            'sms_agree' => ['required', 'boolean'],
            'email_agree' => ['required', 'boolean'],
            'home_number' => ['nullable'],
            'zip_code' => ['required'],
            'address' => ['required', 'string'],
            'detail_address' => ['required', 'string'],
        ]);

        $this->appendPut([
            'current_password' => ['required'],
            'new_password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()->symbols()],
        ], 'edit/password');
    }

}
