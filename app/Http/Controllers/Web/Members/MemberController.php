<?php

namespace App\Http\Controllers\Web\Members;

use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Web\Members\MemberRequest;
use App\Services\Auth\AuthService;
use App\ViewModels\Web\Members\MemberViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class MemberController extends BaseController
{
    protected array $prefix = ['members'];

    protected function init()
    {
        $this->middleware('auth:web')->except([
            'create',
            'create2',
            'create3',
            'create4',
        ]);
        $this->viewModel = new MemberViewModel();
    }

    public function create()
    {
        return $this->buildView('create');
    }

    public function create2()
    {
        $this->viewModel->page = 2;
        return $this->buildView('create2');
    }

    public function create3()
    {
        $this->viewModel->page = 3;
        return $this->buildView('create3');
    }

    public function create4()
    {
        $this->viewModel->page = 4;
        return $this->buildView('create4');
    }

    public function payments(Request $request)
    {
        $member = AuthService::getAuthMember();
        $member->load('payments.paymentItems.lectureProgram.lecture');
        $this->viewModel->page = 4;
        $this->viewModel->menuTitle = '주문/결제내역';
        $this->viewModel->data = $member->payments;
        return $this->buildView('payments');
    }

    public function edit()
    {
        $member = AuthService::getAuthMember();
        $member->load('memberInformation', 'memberPush');
        $this->viewModel->page = 1;
        $this->viewModel->data = $member;
        return $this->buildView('edit');
    }

    public function update(MemberRequest $request)
    {
        $prefix = 'api.member.update';
        $validated = $request->validated();
        $callback = function () use ($prefix, $validated) {
            $member = AuthService::getAuthMember();
            $member->memberPush->bind(Arr::only($validated, ['sms_agree', 'email_agree']));
            $member->memberPush->save();
            $member->memberInformation->bind(Arr::only($validated, ['email', 'home_number', 'zip_code', 'address', 'detail_address']));
            $member->memberInformation->save();
            return $this->backWithConfig($prefix);
        };
        $errorCallback = function (\Throwable $t) use ($prefix) {
            return $this->backWithConfig($prefix, true, false);
        };
        return $this->runTransaction($callback, $errorCallback);
    }

    public function editPassword()
    {
        $member = AuthService::getAuthMember();
        $member->load('memberInformation');
        $this->viewModel->page = 2;
        $this->viewModel->data = $member;
        return $this->buildView('edit_password');
    }

    public function updatePassword(MemberRequest $request)
    {
        $prefix = 'api.member.update.password';
        $validated = $request->validated();
        $callback = function () use ($prefix, $validated) {
            $member = AuthService::getAuthMember();
            $member->pw = Auth::guard()->encryptCredentials($validated['new_password']);
            $member->save();
            return $this->backWithConfig($prefix);
        };
        $errorCallback = function (\Throwable $t) use ($prefix) {
            return $this->backWithConfig($prefix, true, false);
        };
        return $this->runTransaction($callback, $errorCallback);
    }

    public function deleteMember()
    {
        $member = AuthService::getAuthMember();
        $member->load('memberInformation');
        $this->viewModel->page = 3;
        $this->viewModel->data = $member;
        return $this->buildView('delete');
    }
}
