<?php

namespace App\OriginModels\Lectures;

use App\OriginModels\Common\BaseModel;
use App\OriginModels\Members\MembersModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

//차시별 진도체크 테이블
class ClassJumsu2Model extends BaseModel
{
    protected $table = 'lms_class_jumsu2';
    protected $primaryKey = 'jumsu_id';

    public function classUser(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ClassUserModel::class, 'idx', 'user_idx');
    }

}
