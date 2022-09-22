<?php

namespace App\ViewModels\Web\Boards;

use App\ViewModels\Common\BaseViewModel;

class CarefulViewModel extends BaseViewModel
{
    public string $subTitle = '';

    public function __construct(public int $page)
    {
        $this->load();
        $this->subTitleCheck($page);
    }

    protected function subTitleCheck($page)
    {
        $this->subTitle = match ($page) {
            2 => '학습환경설정',
            3 => '필수프로그램',
            4 => '모사방지시스템 운영기준',
            default => '학습유의사항',
        };
    }
}
