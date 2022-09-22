<?php

namespace App\ViewModels\Web\Qna;

use App\ViewModels\Common\BaseViewModel;
use LaravelSupports\Views\Components\BaseComponent;

class QnaViewModel extends BaseViewModel
{
    protected string $dateFormat = 'Y-m-d';
    public $data;
    public $answer;

    protected function init()
    {
        $this->buildSearch('검색', BaseComponent::KEY_SEARCH, [
            'title' => '제목',
            'contents' => '내용',
        ]);
    }
}
