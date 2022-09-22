<?php

namespace App\Guards;

use LaravelSupports\Libraries\Supports\Data\SessionHelper;
use App\User;
use Illuminate\Auth\SessionGuard;

class AdminGuard extends SessionGuard
{
    /**
     * Determine if the user matches the credentials.
     *
     * @param mixed $user
     * @param array $credentials
     * @return bool
     */
    protected function hasValidCredentials($user, $credentials)
    {
        $plain = $credentials['password'];
        if (!is_null($user)) {
            // if ($user->getAuthPassword() === hash('sha256', $plain)) {
            if ($user->getDecPassword() === $plain) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Log the user out of the application.
     *
     * @return void
     */
    public function logout()
    {
        parent::logout();

        SessionHelper::forget(SessionHelper::KEY_SIDEBAR);
        SessionHelper::forget(SessionHelper::KEY_MENUS);
        SessionHelper::forget(SessionHelper::KEY_THREE_DEPTH_MENUS);
        SessionHelper::forget(SessionHelper::KEY_FAVORITES);
    }
}
