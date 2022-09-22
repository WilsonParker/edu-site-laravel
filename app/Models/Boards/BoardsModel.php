<?php


namespace App\Models\Boards;


use App\Models\Common\ResourceableModel;
use App\Models\Common\ResourcesModel;
use App\Models\Members\MembersModel;

class BoardsModel extends ResourceableModel
{
    protected $table = 'boards';

    public function boardCategory(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(BoardCategoriesModel::class);
    }

    public function member(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MembersModel::class);
    }

    public function boardAnswer(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(BoardAnswersModel::class);
    }

    public function file(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ResourcesModel::class, 'idx', 'file_idx');
    }

    public function getResourcePath(): string
    {
        return '/board';
    }

}
