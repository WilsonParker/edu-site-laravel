<?php

namespace App\OriginModels\Lectures;

use App\OriginModels\Common\BaseModel;

// 설문조사 테이블
class ClassVoteModel extends BaseModel
{
    protected $table = 'lms_class_vote';
    protected $primaryKey = 'vote_id';

    public function vote(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(VoteModel::class, 'vote_id', 'vote_id');
    }

}
