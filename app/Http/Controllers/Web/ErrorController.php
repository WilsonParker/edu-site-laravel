<?php

namespace App\Http\Controllers\Web;

use LaravelSupports\ViewModels\BaseViewModel;

class ErrorController extends BaseController
{
    protected array $prefix = ['error'];

    protected function init()
    {
        $this->viewModel = new BaseViewModel();
    }

    public function notFound()
    {
        return $this->buildView('404');
    }

    public function internalServerError()
    {
        return $this->buildView('404');
    }
}
