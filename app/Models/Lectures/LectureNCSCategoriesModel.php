<?php


namespace App\Models\Lectures;


use App\Models\Common\BaseCodeModel;

class LectureNCSCategoriesModel extends BaseCodeModel
{
    use HashManyLecturesTrait;

    protected $table = 'lecture_ncs_categories';
}
