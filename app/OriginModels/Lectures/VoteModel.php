<?php

namespace App\OriginModels\Lectures;

use App\OriginModels\Common\BaseModel;
use App\OriginModels\Members\MembersModel;

// 설문 응답
class VoteModel extends BaseModel
{
    protected $table = 'lms_vote';

    public function classVote(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ClassVoteModel::class, 'vote_id', 'vote_id');
    }

    public function member(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MembersModel::class, 'user_id', 'user_id');
    }
}
