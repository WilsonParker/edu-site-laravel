<?php

namespace App\Http\Controllers\Web\Lectures;

use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Web\Lectures\PaymentRequest;
use App\Models\Lectures\LectureProgramModel;
use App\Models\Payments\PaymentsModel;
use App\Services\Auth\AuthService;
use App\Services\Lectures\LectureService;
use App\Services\Payments\PaymentService;
use App\ViewModels\Web\Lectures\PaymentViewModel;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use LaravelSupports\Libraries\Supports\Http\Responses\ResponseDefaultConfigTemplate;
use LaravelSupports\Libraries\Supports\Http\Responses\ResponseErrorTemplate;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Throwable;

class PaymentController extends BaseController
{
    protected array $prefix = ['lectures', 'payments'];

    protected function init()
    {
        $this->middleware(['auth:web'])->except(['hooks']);
    }

    public function normal(PaymentRequest $request)
    {
        $model = LectureProgramModel::with(['lecture.category'])->findOrFail($request->validated()['idx']);
        $this->viewModel = new PaymentViewModel($model);
        $this->viewModel->member = AuthService::getAuthMember();
        $this->viewModel->total = $model->lecture->price;
        return $this->buildView('normal');
    }

    public function cart(PaymentRequest $request)
    {
        $member = AuthService::getAuthMember();
        $models = $member->carts()->with('lecture.normalPrograms')->whereIn('idx', $request->validated()['idx'])->get();
        $this->viewModel = new PaymentViewModel($models);
        $this->viewModel->member = $member;
        $this->viewModel->total = $models->sum('lecture.price');
        return $this->buildView('cart');
    }

    public function nbc(PaymentRequest $request)
    {
        $model = LectureProgramModel::getModel($request->validated()['idx']);
        $this->viewModel = new PaymentViewModel($model);
        $this->viewModel->member = AuthService::getAuthMember();
        $this->viewModel->total = $model->lecture->price;
        return $this->buildView('nbc');
    }

    public function paymentReady(PaymentRequest $request)
    {
        $prefix = 'api.lecture.payment.ready';
        $validated = $request->validated();
        $callback = function () use ($prefix, $validated) {
            $member = AuthService::getAuthMember();
            $models = LectureProgramModel::with('lecture')->whereIn('idx', $validated['idx'])->get();
            $service = new PaymentService($models, $member, $validated['method']);
            return new ResponseDefaultConfigTemplate(ResponseAlias::HTTP_OK, $prefix, $service->ready());
        };
        $errCallback = function (Throwable $t) {
            return new ResponseErrorTemplate($t);
        };
        return $this->runTransaction($callback, $errCallback);
    }

    public function paymentPaid(PaymentRequest $request): \LaravelSupports\Libraries\Supports\Http\Responses\ResponseTemplate
    {
        $prefix = 'api.lecture.payment.paid';
        $validated = $request->validated();
        $callback = function () use ($prefix, $validated) {
            $result = Arr::only($validated, ['request_id', 'unique_id', 'price', 'pg_provider', 'pg_unique_id', 'receipt_url', 'card_approval', 'card_name', 'card_number', 'card_quota', 'vbank_date', 'vbank_name', 'vbank_num']);
            PaymentsModel::where('request_id', $validated['request_id'])->update($result);
            return new ResponseDefaultConfigTemplate(ResponseAlias::HTTP_OK, $prefix);
        };
        $errCallback = function (Throwable $t) {
            return new ResponseErrorTemplate($t);
        };
        return $this->runTransaction($callback, $errCallback);
    }

    public function hooks(PaymentRequest $request): \LaravelSupports\Libraries\Supports\Http\Responses\ResponseTemplate
    {
        Log::info('payments webhook : ' . $request->ip());
        $validated = $request->validated();
        $prefix = 'api.lecture.payment.hooks';
        $callback = function () use ($prefix, $validated) {
            Log::info('payments webhook : ' . json_encode($validated));
            $payments = PaymentsModel::with(['lecturePrograms'])->where('request_id', $validated['merchant_uid'])->first();
            if ($validated['status'] == 'paid' && $payments->status == 'ready') {
                $payments->paid_price = $payments->price - $payments->sale_price;
                $payments->paid_at = now();
                $service = new LectureService($payments->member);
                $service->provides($payments->lecturePrograms);
            }
            $payments->status = $validated['status'];
            $payments->save();
            return new ResponseDefaultConfigTemplate(ResponseAlias::HTTP_OK, $prefix);
        };
        $errCallback = function (Throwable $t) {
            return new ResponseErrorTemplate($t);
        };
        return $this->runTransaction($callback, $errCallback);
    }
}
