<?php

namespace App\Http\Controllers\Web\Pages;

use App\Http\Controllers\Web\BaseController;
use App\ViewModels\Web\Pages\PageViewModel;

class PageController extends BaseController
{
    protected array $prefix = ['pages'];

    protected function init()
    {
        $this->viewModel = new PageViewModel();
    }

    // 내일배움카드 - 내일배움카드제도 안내 - 제도소개
    public function nbcPage1()
    {
        $this->viewModel->page = 1;
        $this->viewModel->meneTitle = '내일배움카드 제도소개';
        return $this->buildView('nbc_page1');
    }

    // 내일배움카드 - 내일배움카드제도 안내 - 지원대상
    public function nbcPage2()
    {
        $this->viewModel->page = 2;
        $this->viewModel->meneTitle = '내일배움카드 지원대상';
        return $this->buildView('nbc_page2');
    }

    // 내일배움카드 - 내일배움카드제도 안내 - 지원절차
    public function nbcPage3()
    {
        $this->viewModel->page = 3;
        $this->viewModel->meneTitle = '내일배움카드 지원절차';
        return $this->buildView('nbc_page3');
    }

    // 내일배움카드 - 내일배움카드제도 안내 - 지원내용
    public function nbcPage4()
    {
        $this->viewModel->page = 4;
        $this->viewModel->meneTitle = '내일배움카드 지원내용';
        return $this->buildView('nbc_page4');
    }

    // 내일배움카드 - 훈련진행절차 안내
    public function nbcPageTraining()
    {
        return $this->buildView('nbc_page_training');;
    }

    // 내일배움카드 - 가드신청안내
    public function nbcPageCard()
    {
        return $this->buildView('nbc_page_card');;
    }

    // 기업교육 - 사업주훈련제도 안내 - 지원대상
    public function businessPage1()
    {
        $this->viewModel->page = 1;
        $this->viewModel->meneTitle = '사업주훈련지원과정 지원대상';
        return $this->buildView('business_page1');
    }

    // 기업교육 - 사업주훈련제도 안내 - 지원절차
    public function businessPage2()
    {
        $this->viewModel->page = 2;
        $this->viewModel->meneTitle = '사업주훈련지원과정 지원절차';
        return $this->buildView('business_page2');
    }

    // 기업교육 - 사업주훈련제도 안내 - 지원내용
    public function businessPage3()
    {
        $this->viewModel->page = 3;
        $this->viewModel->meneTitle = '사업주훈련지원과정 지원내용';
        return $this->buildView('business_page3');
    }

    // 기업교육 - 사업주훈련제도 안내 - 제도소개
    public function businessPage4()
    {
        $this->viewModel->page = 4;
        $this->viewModel->meneTitle = '사업주훈련지원과정 제도소개';
        return $this->buildView('business_page4');
    }

    // 기업교육 - 훈련진행절차 안내
    public function businessPageTraining()
    {
        return $this->buildView('business_page_training');;
    }

    // 기업교육 - 환급절차안내
    public function businessPageRefunds()
    {
        return $this->buildView('business_page_refunds');;
    }
}
