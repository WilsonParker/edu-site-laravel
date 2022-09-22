<?php

namespace App\Http\Middleware;

use App\Guards\MemberGuard;
use Illuminate\Session\Middleware\AuthenticateSession;

class AuthenticatedSession extends AuthenticateSession
{
    protected function guard()
    {
        return new MemberGuard();
    }
}
