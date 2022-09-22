<?php

namespace Database\Seeders;

use App\Models\Boards\BoardCategoriesModel;
use Illuminate\Database\Seeder;

class BoardCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->store('notice', '공지사항', 1);
        $this->store('event', '이벤트', 2);
        $this->store('ncs_info', 'NCS 직업교육 신청방법', 3);
        $this->store('guide', '기업별 직업교육 가이드', 4);
        $this->store('ncs_faq', 'NCS 직업교육 FAQ', 5);
        $this->store('others', '기타 (사후관리)', 6);
        //$this->store('faq', '자주하는 질문(FAQ)', 7);
        $this->store('faq_join', '회원가입/로그인', 7);
        $this->store('faq_lecture', '수강신청/학습', 8);
        $this->store('faq_hrd', '내일배움카드', 9);
        $this->store('faq_exam', '시험/과제', 10);
        $this->store('faq_ncs', 'NCS 직업교육', 11);
        $this->store('faq_certificate', '수료증', 12);
        $this->store('faq_pay', '결제/환불', 13);
        $this->store('faq_others', '기타', 14);
        $this->store('question', '질문', 15);

    }

    private function store(string $code, string $name, int $sort, bool $public = true)
    {
        BoardCategoriesModel::create([
            'code' => $code,
            'name' => $name,
            'sort' => $sort,
            'is_public' => $public,
        ]);
    }
}
