<?php

namespace App\Http\Controllers\Web\Lectures;

use App\Http\Controllers\Web\BaseController;
use App\Models\Members\MemberExamsModel;
use App\Models\Members\MemberLectureClassesModel;
use App\Providers\RouteServiceProvider;
use App\Services\Auth\AuthService;
use App\ViewModels\Web\Lectures\CertificationViewModel;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CertificationController extends BaseController
{
    use RedirectsUsers;

    protected array $prefix = ['lectures'];

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected string $redirectTo = RouteServiceProvider::HOME;

    protected function init()
    {
        $this->middleware(['auth:web']);
    }

    public function otp(Request $request)
    {
        $this->viewModel = new CertificationViewModel($request->collect()->toArray());
        $this->viewModel->member = AuthService::getAuthMember();
        return $this->buildView('otp');
    }

    public function complete(Request $request)
    {
        if ($request->has('class')) {
            $model = MemberLectureClassesModel::where([
                'member_idx' => AuthService::getAuthMember()->idx,
                'member_lecture_program_idx' => $request->input('program'),
                'lecture_class_idx' => $request->input('class'),
            ])->firstOrFail();
        } else if ($request->has('exam')) {
            $model = MemberExamsModel::findOrFail($request->input('exam'));
        }
        $model->certification = true;
        $model->save();

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->intended($this->redirectPath());
    }

}
