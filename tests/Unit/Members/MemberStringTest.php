<?php

namespace Tests\Unit\Members;

use App\Models\Lectures\LectureCategoriesModel;
use App\Models\Lectures\LectureNCSCategoriesModel;
use App\Models\Members\MembersModel;
use App\OriginModels\Lectures\CategoryModel;
use App\OriginModels\Lectures\CourseModel;
use Tests\TestCase;
use Illuminate\Support\Str;

class MemberStringTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function tesqString()
    {
        $co_gubun = '3';
        dump(($co_gubun=='1')?'pir': (($co_gubun=='2') ? 'thm':'thl'));
    }

    public function testSelect()
    {
        $query = MembersModel::where('id','swsijc')->first();
        dump($query->idx);
    }

    public function testsString()
    {
        CourseModel::limit(10)->whereNotNull('category_id2')->get()->each(function ($item) {

            if(($item->category_id2)!=null)
            {
                dump('chcek');
                dump($item->category_id2);
            }

            dump($item->category_id);
            if($item->category_id!='A0001' && $item->category_id!='A0002' && $item->category_id!='A0003')
            {
                $category_sel = CategoryModel::where('category_id', $item->category_id)->first();
                $category= Str::substr($category_sel->category_title, 0, 8);
                $lec_category = LectureCategoriesModel::where('number_code',$category)->first();
                dump($lec_category->code);
            }
        });
    }
}
