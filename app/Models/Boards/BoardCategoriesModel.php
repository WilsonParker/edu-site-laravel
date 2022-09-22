<?php


namespace App\Models\Boards;


use App\Models\Common\BaseCodeModel;
use App\Models\Lectures\MemberLectureCardinalNumbersModel;

class BoardCategoriesModel extends BaseCodeModel
{
    protected $table = 'board_categories';

    public function boards(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(BoardsModel::class);
    }

    public function type(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(BoardTypesModel::class, BoardCategoryTypePivotModel::class);
    }
}
