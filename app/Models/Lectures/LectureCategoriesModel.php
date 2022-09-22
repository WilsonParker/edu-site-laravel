<?php


namespace App\Models\Lectures;


use App\Models\Common\BaseCodeModel;
use App\Models\Traits\HasManyLecturesTrait;

class LectureCategoriesModel extends BaseCodeModel
{
    use HasManyLecturesTrait;

    protected $table = 'lecture_categories';

    public function parent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(self::class, 'parent', 'code');
    }

    public function getNumberText(): string
    {
        return $this->number_code . $this->name;
    }

    public function getNumberTextInDetail(): string
    {
        return "$this->name($this->number_code)";
    }
}
