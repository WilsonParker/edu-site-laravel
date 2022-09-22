<?php

namespace App\OriginModels\Lectures;

use App\OriginModels\Common\BaseModel;
use App\OriginModels\Members\MembersModel;

// 시험정보저장 테이블
class ClassJumsuModel extends BaseModel
{
    protected $table = 'lms_class_jumsu';

    public function member(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MembersModel::class, 'user_idx', 'idx');
    }

    public function classUser(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ClassUserModel::class,'idx','user_idx');
    }
}
