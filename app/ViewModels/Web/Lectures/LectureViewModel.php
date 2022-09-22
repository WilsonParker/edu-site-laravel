<?php

namespace App\ViewModels\Web\Lectures;

use App\Models\Lectures\LectureCategoriesModel;
use App\ViewModels\Common\BaseViewModel;
use LaravelSupports\ViewModels\BaseViewModel as BaseViewModelAlias;

class LectureViewModel extends BaseViewModel
{
    protected string $dateFormat = 'Y-m-d';
    public $categories;
    public LectureCategoriesModel $selectedCategory;
    public bool $hasFilter = true;
    public ?string $type = null;
    public int $total = 0;

    protected function init()
    {
        $this->buildSort(BaseViewModelAlias::KEY_SORT, [
            'best' => '인기순',
            'price_asc' => '수강료 낮은순',
            'course_time_asc' => '수강차시 짧은순',
        ]);

        $this->buildFilter(BaseViewModelAlias::KEY_FILTER, [
            'no_task' => ['과제 없음', '평가가 시험으로만 이루어져있고, 과제가 없는 과정입니다.',],
            'has_study' => ['학습 자료 있음', '학습자료를 다운로드 받을 수 있는 과정입니다.'],
            'certificate' => ['수료증 즉시 발급', '평가응시 후 자동채점 되어 수료증을 즉시 발급받을 수 있는 과정입니다.'],
        ]);
    }

    public function getCategoryTitle(): string
    {
        return match ($this->type) {
            'semiconductor' => 'NCS반도체교육',
            'it' => 'IT교육',
            default => 'NCS직업교육',
        };
    }

    public function getSelectedCategoryTitle(): string
    {
        return $this->selectedCategory?->getNumberText();
    }

    public function getCategory(string $code)
    {
        return $this->categories->first(function ($item) use ($code) {
            return $item->code == $code;
        });
    }

}
