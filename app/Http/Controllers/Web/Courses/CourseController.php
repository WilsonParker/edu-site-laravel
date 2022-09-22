<?php

namespace App\Http\Controllers\Web\Courses;

use App\Http\Controllers\Web\BaseController;
use App\Models\Lectures\LectureCategoriesModel;
use App\ViewModels\Common\BaseViewModel;

class CourseController extends BaseController
{
    protected array $prefix = ['courses'];

    protected function init()
    {
        $this->viewModel = new BaseViewModel();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // 초기 sub_menu
        $title = 'NCS 직업교육';

        //카테고리 정의
        $query = LectureCategoriesModel::where('number_code','!=','')->get();
        $arrayCategory =[];
        $i = 0;
        foreach($query as $item){
            $arrayCategory[$i]['name'] = $item->name;
            $arrayCategory[$i]['code'] = $item->number_code;
            $i++;
        }
        return $this->buildView('index')->with(['title' => $title, 'arrayCategory'=>$arrayCategory]);
    }
}
