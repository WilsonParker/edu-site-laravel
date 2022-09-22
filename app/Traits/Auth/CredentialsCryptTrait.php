<?php

namespace App\Traits\Auth;

trait CredentialsCryptTrait
{
    public function isValidateCredentials($user, string $plain): bool
    {
        return hash('sha256', $plain) == $user->pw;
    }

    public function encryptCredentials(string $plain): string
    {
        return hash('sha256', $plain);
    }
}
