<?php


namespace App\Models\Boards;


use App\Models\Common\BaseModel;
use App\Models\Lectures\MemberLectureCardinalNumbersModel;
use App\Models\Members\MembersModel;

class BoardAnswersModel extends BaseModel
{
    protected $table = 'board_answers';

    public function board(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(BoardsModel::class);
    }

    public function member(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MembersModel::class);
    }
}
