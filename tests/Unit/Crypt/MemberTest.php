<?php

namespace Tests\Unit\Crypt;

use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

class MemberTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPw()
    {
        $hashedPW = '79140f00193496670a87d1be2bc80ec8d891387d6265ff2f5c672d7adf5e1bb6';
        $pw = 'aa1234';

        $enc = Crypt::encryptString($pw);
        $dnc = Crypt::decryptString($enc);

        $encHashPw = Crypt::encryptString($hashedPW);
        $dncHashPw = Crypt::decryptString($encHashPw);

        dump($enc);
        dump($dnc);
        dump($encHashPw);
        dump($dncHashPw);
        dump($hashedPW == hash('sha256', $pw));
        dump($dncHashPw == hash('sha256', $pw));
    }
}
