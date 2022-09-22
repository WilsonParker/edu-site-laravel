<?php

namespace App\OriginModels\Lectures;

use App\OriginModels\Common\BaseModel;

//과정카테고리 테이블
class CategoryModel extends BaseModel
{
    protected $table = 'lms_category';
    protected $primaryKey = 'category_id';
}
