<?php

namespace App\OriginModels\Lectures;

use App\OriginModels\Common\BaseModel;
use App\OriginModels\Members\LoginModel;
use App\OriginModels\Members\MembersModel;

//차시별 진도체크 테이블
class ClassJumsu2LoginModel extends BaseModel
{
    protected $table = 'lms_class_jumsu2_login';
    protected $primaryKey = 'no';

    public function login(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(LoginModel::class);
    }

    public function class(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ClassModel::class, 'class_id', 'class_id');
    }

    public function member(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MembersModel::class, 'user_idx', 'idx');
    }

    public function memberWithId(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MembersModel::class, 'user_id', 'user_id');
    }
}
