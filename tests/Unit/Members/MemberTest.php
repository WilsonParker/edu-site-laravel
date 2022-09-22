<?php

namespace Tests\Unit\Members;

use App\Models\Members\MembersModel;
use App\Models\Members\MemberTypesModel;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class MemberTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPw()
    {
        $model = MembersModel::getModel(1);
        $type = MemberTypesModel::getModel('admin');
        $model->type = $type;
        $model->save();
    }

    public function testUpdatePassword()
    {
        $this->createApplication();

        $member = MembersModel::where('id', 'dev9163')->first();
        dump($member->idx);
        $hashed = hash('sha256', 'dev9163');
        $encrypted = Crypt::encryptString($hashed);
        $member->pw = $member->encryptCredentials('dev9163');
        $member->save();

        $this->log();
        dump($hashed);
        dump($encrypted);
        dump(Crypt::decryptString($encrypted));
        dump($member->pw);
        // dump(Crypt::decryptString($member->pw));
    }

    public function testHashCheck()
    {
        $this->createApplication();

        $plain = 'dev9163';

        dump(hash('sha256', $plain));

        $salt10 = Hash::make($plain, [
            'rounds' => 10,
        ]);

        $salt12 = Hash::make($plain, [
            'rounds' => 12,
        ]);
        dump($salt10);
        dump($salt12);

        dump(Hash::check($plain, $salt10, [
            'rounds' => 11
        ]));
        dump(Hash::check($plain, $salt12, [
            'rounds' => 12
        ]));

        dump(Hash::check($plain, $salt10));
        dump(Hash::check($plain, $salt12));

        dump(Hash::check($salt10, $salt12));
    }

    public function testPWCheck()
    {
        $member = MembersModel::find(5502);
        $plain = 'dev9163';

        dump(Hash::check($plain, $member->pw));
        dump(Hash::make($plain) == $member->pw);
        dump(hash('sha256', $plain) == $member->pw);
    }
}
