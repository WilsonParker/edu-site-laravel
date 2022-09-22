<?php

namespace App\ViewModels\Web\Boards;

use App\ViewModels\Common\BaseViewModel;
use LaravelSupports\Views\Components\BaseComponent;

class BoardViewModel extends BaseViewModel
{
    public string $code = '';
    public $selectedCategory;
    public $categories;
    public $data;

    protected function init()
    {
        $this->buildSearch('검색', BaseComponent::KEY_SEARCH, [
            'title' => '제목',
            'contents' => '내용',
        ]);
    }
}
