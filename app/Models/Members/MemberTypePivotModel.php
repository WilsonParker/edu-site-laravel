<?php


namespace App\Models\Members;


use App\Models\Common\BaseModel;
use App\Models\Lectures\MemberLectureCardinalNumbersModel;

class MemberTypePivotModel extends BaseModel
{
    protected $table = 'member_type_pivot';
}
