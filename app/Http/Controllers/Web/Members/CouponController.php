<?php

namespace App\Http\Controllers\Web\Members;

use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Web\Members\CouponRequest;
use App\Services\Auth\AuthService;
use App\ViewModels\Web\Members\CouponViewModel;

class CouponController extends BaseController
{
    protected array $prefix = ['members', 'coupons'];

    protected function init()
    {
        $this->middleware('auth:web');
        $this->viewModel = new CouponViewModel();
    }

    public function index()
    {
        return $this->buildView('index');
    }

    public function useCoupon(CouponRequest $request)
    {
        $prefix = 'api.member.coupon.use';
        $validated = $request->validated();
        $callback = function () use ($prefix, $validated) {
            $member = AuthService::getAuthMember();
            return $this->backWithConfig($prefix);
        };
        $errorCallback = function (\Throwable $t) use ($prefix) {
            return $this->backWithConfig($prefix, true, false);
        };
        return $this->runTransaction($callback, $errorCallback);
    }

}
