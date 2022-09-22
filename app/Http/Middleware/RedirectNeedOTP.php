<?php

namespace App\Http\Middleware;

use App\Models\Members\MemberLectureClassesModel;
use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Arr;

class RedirectNeedOTP
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
        $this->verify($request, $guards);

        return $next($request);
    }

    /**
     * Determine if the user is logged in to any of the given guards.
     *
     * @param \Illuminate\Http\Request $request
     * @param array $guards
     * @return void
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    protected function verify(\Illuminate\Http\Request $request, array $guards)
    {
        if (empty($guards)) {
            $guards = [null];
        }

        $parameters = $request->route()->parameters();
        $program = $parameters['program'];
        if (Arr::exists($parameters, 'class') && $parameters['class']->number % 8 == 1) {
            $memberLectureClassModel = MemberLectureClassesModel::where([
                'member_idx' => $program->member_idx,
                'member_lecture_program_idx' => $program->idx,
                'lecture_class_idx' => $parameters['class']->idx,
            ])->firstOrFail();

            $isClassOTP = !$memberLectureClassModel->certification;
            $this->params['class'] = $parameters['class'];
            $this->params['program'] = $parameters['program'];
        } else {
            $isClassOTP = false;
        }

        $hasExamOTP = true;
        $type = $parameters['type'] ?? null;
        if (!$isClassOTP && isset($type)) {
            $exam = $program->memberExams->first(function ($exam) use ($type) {
                return $exam->exam_type_code == $type;
            });
            $hasExamOTP = $exam?->certification ?? false;
            $this->params['exam'] = $exam;
        }

        if ($isClassOTP || !$hasExamOTP) {
            $this->uncertified($request, $guards);
        }

    }

    /**
     * Handle an uncertified user.
     *
     * @param \Illuminate\Http\Request $request
     * @param array $guards
     * @return void
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    protected function uncertified(\Illuminate\Http\Request $request, array $guards)
    {
        throw new AuthenticationException(
            'Uncertified.', $guards, $this->redirectTo($request)
        );
    }

    /**
     * Get the path the user should be redirected to when they are not uncertified.
     *
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('lectures.otp', $this->params);
        }
    }
}
