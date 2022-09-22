<?php


namespace App\Models\Lectures;


use App\Models\Common\BaseModel;
use App\Models\Traits\HasManyLecturesTrait;

class LectureCompaniesModel extends BaseModel
{
    use HasManyLecturesTrait;

    protected $table = 'lecture_companies';
}
