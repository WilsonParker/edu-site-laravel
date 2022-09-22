<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Web\BaseController;
use App\Providers\RouteServiceProvider;
use App\Traits\Auth\CredentialsCryptTrait;
use App\ViewModels\Common\BaseViewModel;
use App\ViewModels\Web\Auth\AuthViewModel;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;

class AuthController extends BaseController
{
    use AuthenticatesUsers, CredentialsCryptTrait;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    protected array $prefix = ['auth'];

    protected function init()
    {
        $this->middleware('guest')->except('logout');
        $this->viewModel = new AuthViewModel();
    }

    protected function guard()
    {
        return Auth::guard('web');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'id';
    }

    /**
     * Validate the user login request.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    /**
     * The user has been authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @param mixed $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        $this->redirectTo = $request->input('link', $this->redirectTo);
//        Auth::guard('web')->setCookieJar(new CookieJar());
//        Auth::guard('web')->logoutOtherDevices($request->password, 'pw');
//        auth()->logoutOtherDevices($request->password, 'pw');

        /*$agent = new Agent();
        dump($agent->getUserAgent());
        dump($agent->browser());
        dump($agent->version($agent->browser()));
        dump($agent->platform());
        dump($agent->version($agent->platform()));
        dump($agent->device());
        exit;*/
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $this->viewModel->link = $request->input('link', '/');
        return $this->buildView('index');
    }

}
