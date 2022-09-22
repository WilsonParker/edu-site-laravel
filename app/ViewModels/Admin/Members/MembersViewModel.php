<?php

namespace App\ViewModels\Admin\Members;

use App\Services\Recommend\Traits\HasFeelingsTraits;
use App\Services\Recommend\Traits\HasInterestsTraits;
use App\ViewModels\Common\BasicViewModel;
use FlyBookModels\Configs\FeelingsModel;
use FlyBookModels\Configs\InterestsModel;
use FlyBookModels\Membership\MemberShipModel;
use LaravelSupports\Views\Components\Tables\TableSearchComponent;

class MembersViewModel extends BasicViewModel
{
    use HasInterestsTraits;
    use HasFeelingsTraits;

    const SEARCH_KEY_FILTER = 'filters';

    protected string $dateFormat = 'Y-m-d';
    public $membershipList;
    public $interests;
    public $feelings;

    protected function init()
    {
        $this->buildSearch('필터', self::SEARCH_KEY_FILTER, [
            'all' => '전체',
            'basic' => '일반',
            'membership' => '멤버십',
            'premium' => '프리미엄',
            'standard' => '스탠다드',
        ]);

        $this->buildSearch('검색', TableSearchComponent::KEY_SEARCH, [
            'realname' => '이름',
            'nickname' => '닉네임',
            'id' => '번호',
        ]);

        $this->membershipList = MemberShipModel::all();
        $this->interests = InterestsModel::all();
        $this->feelings = FeelingsModel::all();
    }

    public function tableHeader(): string
    {
        return '
            <th>번호</th>
            <th>이메일</th>
            <th>닉네임</th>
            <th>이름</th>
            <th>나이</th>
            <th>성별</th>
            <th>연락처</th>
            <th>직업</th>
            <th>가입 일</th>
        ';
    }

    public function buildBadge($text): string
    {
        return "<span class='badge badge-pill badge-success'>$text</span><br/>";
    }
}
