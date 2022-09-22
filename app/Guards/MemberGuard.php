<?php

namespace App\Guards;

use App\Traits\Auth\CredentialsCryptTrait;
use Illuminate\Auth\SessionGuard;
use InvalidArgumentException;

class MemberGuard extends SessionGuard
{
    use CredentialsCryptTrait;

    /**
     * Determine if the user matches the credentials.
     *
     * @param mixed $user
     * @param array $credentials
     * @return bool
     */
    protected function hasValidCredentials($user, $credentials): bool
    {
        $plain = $credentials['password'];
        if (!is_null($user)) {
            if ($this->isValidateCredentials($user, $plain)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    protected function rehashUserPassword($password, $attribute)
    {
        if (!$this->isValidateCredentials($this->user(), $password)) {
            throw new InvalidArgumentException('The given password does not match the current password.');
        }

        return tap($this->user()->forceFill([
            $attribute => $this->encryptCredentials($password),
        ]))->save();
    }

    /**
     * Log the user out of the application.
     *
     * @return void
     */
    public function logout()
    {
        parent::logout();
    }

}
