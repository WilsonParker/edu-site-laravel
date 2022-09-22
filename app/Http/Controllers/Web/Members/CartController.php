<?php

namespace App\Http\Controllers\Web\Members;

use App\Exceptions\Lectures\Carts\AlreadyExistsException;
use App\Exceptions\Lectures\Carts\CartsException;
use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Web\Lectures\CartRequest;
use App\Models\Lectures\CartsModel;
use App\Models\Lectures\LecturesModel;
use App\Services\Auth\AuthService;
use App\ViewModels\Web\Members\CartViewModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use LaravelSupports\Libraries\Supports\Http\Responses\ResponseConfigTemplate;
use LaravelSupports\Libraries\Supports\Http\Responses\ResponseDefaultConfigTemplate;
use LaravelSupports\Libraries\Supports\Http\Responses\ResponseErrorTemplate;
use LaravelSupports\Libraries\Supports\Http\Responses\ResponseTemplate;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CartController extends BaseController
{
    protected array $prefix = ['members'];
    protected int $paginate = 10;

    protected function init()
    {
        $this->middleware(['auth:web']);
    }

    public function index(Request $request)
    {
        $member = AuthService::getAuthMember();
        $data = $this->buildQueryPagination($request, $member->carts()->getQuery());
        $this->viewModel = new CartViewModel($data);
        $this->viewModel->page = 3;
        $this->viewModel->menuTitle = '장바구니';
        return $this->buildView('cart');
    }

    public function store(CartRequest $request)
    {
        $prefix = 'api.member.cart.store';
        $validated = $request->validated();
        $callback = function () use ($prefix, $validated) {
            $member = AuthService::getAuthMember();
            $lecture = LecturesModel::findOrFail($validated['lecture']);
            if ($member->whereHas('carts', function ($query) use ($lecture) {
                $query->where('lecture_idx', $lecture->idx);
            })->exists()) {
                throw new AlreadyExistsException();
            } else {
                $member->cartLectures()->save($lecture);
            }
            return new ResponseDefaultConfigTemplate(ResponseAlias::HTTP_OK, $prefix);
        };
        $errorCallback = function (\Throwable $t) use ($prefix) {
            if ($t instanceof CartsException) {
                return new ResponseErrorTemplate($t);
            }
            return new ResponseDefaultConfigTemplate(ResponseAlias::HTTP_BAD_REQUEST, $prefix);
        };
        return $this->runTransaction($callback, $errorCallback);
    }

    public function destroy(Request $request, CartsModel $cart)
    {
        $prefix = 'api.member.cart.destroy';
        $callback = function () use ($prefix, $cart) {
            $cart->forceDelete();
            return new ResponseDefaultConfigTemplate(ResponseAlias::HTTP_OK, $prefix);
        };
        $errorCallback = function (\Throwable $t) use ($prefix) {
            return new ResponseDefaultConfigTemplate(ResponseAlias::HTTP_BAD_REQUEST, $prefix);
        };
        return $this->runTransaction($callback, $errorCallback);
    }

    public function deletes(CartRequest $request)
    {
        $prefix = 'api.member.cart.destroy';
        $validated = $request->validated();
        $callback = function () use ($prefix, $validated) {
            CartsModel::whereIn('idx', $validated['carts'])->forceDelete();
            return new ResponseDefaultConfigTemplate(ResponseAlias::HTTP_OK, $prefix);
        };
        $errorCallback = function (\Throwable $t) use ($prefix) {
            return new ResponseDefaultConfigTemplate(ResponseAlias::HTTP_BAD_REQUEST, $prefix);
        };
        return $this->runTransaction($callback, $errorCallback);
    }

}
