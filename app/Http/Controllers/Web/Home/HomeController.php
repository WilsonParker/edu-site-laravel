<?php

namespace App\Http\Controllers\Web\Home;

use App\Http\Controllers\Web\BaseController;
use App\ViewModels\Common\BaseViewModel;
use Jenssegers\Agent\Agent;

class HomeController extends BaseController
{

    protected function init()
    {
        $this->viewModel = new BaseViewModel();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return $this->buildView('index');
    }
}
