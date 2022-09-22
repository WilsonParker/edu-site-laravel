<?php


namespace App\Services\Auth;


use App\Models\Members\MembersModel;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public static function getAuthMember(): ?\Illuminate\Contracts\Auth\Authenticatable
    {
        return Auth::user();
        return self::getTestMember();
    }

    public static function getTestMember()
    {
        return MembersModel::find(5502);
    }

    public static function isAuthorize(): bool
    {
        return Auth::check();
    }

}
