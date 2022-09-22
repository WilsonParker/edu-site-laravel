<?php

namespace App\Http\Middleware;

use App\Library\LaravelSupports\app\Controllers\Traits\RedirectTraits;
use App\Models\Lectures\ExamKind;
use App\Services\Auth\AuthService;
use App\Services\Lectures\LectureService;
use Closure;
use Illuminate\Http\Request;

class LectureEvaluable
{
    use RedirectTraits;

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws \Throwable
     */
    public function handle(Request $request, Closure $next)
    {
        $parameters = $request->route()->parameters();
        $member = AuthService::getAuthMember();
        try {
            $service = new LectureService($member);
            $service->isEvaluable(ExamKind::from($parameters['type']), $parameters['program']);
        } catch (\Throwable $throwable) {
            $route = route('members.lectures.detail', $member->memberLecturePrograms()->where('lecture_program_idx', $parameters['program']->lectureProgram->idx)->firstOrFail());
            return $this->redirectUrlWithMessage($throwable->getMessage(), $route);
        }

        return $next($request);
    }
}
