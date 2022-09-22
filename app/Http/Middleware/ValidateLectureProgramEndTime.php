<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Arr;

class ValidateLectureProgramEndTime
{
    private array $params = [];

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string[] ...$guards
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle(\Illuminate\Http\Request $request, Closure $next, ...$guards)
    {
        $parameters = $request->route()->parameters();
        if(Arr::exists($parameters, 'history')) {
            $program = $parameters['history']->memberLectureProgram;
        } else {
            $program = $parameters['program'] ?? $parameters['lecture'];
        }

        // 강의 수강 기간이 지났을 경우
        if (now()->greaterThan($program->learning_end_date)) {
            return redirect()->route('members.lectures.learning')->with([
                'message' => '종료된 강의 입니다.'
            ]);
        }

        return $next($request);
    }

}
