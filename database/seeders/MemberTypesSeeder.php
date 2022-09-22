<?php

namespace Database\Seeders;

use App\Models\Members\MemberTypesModel;
use Illuminate\Database\Seeder;

class MemberTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->store('admin', '관리자', '관리자 사이트에 접속할 수 있는 회원 입니다.');
        $this->store('member', '회원', '일반 회원 입니다.');
        $this->store('tutor', '강사', '강사 사이트에 접속할 수 있는 회원 입니다.');
        $this->store('business','사업주','사업주 사이트에 접속할 수 있는 회원 입니다.');
    }

    private function store(string $code, string $name, string $description)
    {
        MemberTypesModel::create([
            'code' => $code,
            'name' => $name,
            'description' => $description,
        ]);
    }
}
