<?php

namespace App\OriginModels\Lectures;

use App\OriginModels\Common\BaseModel;
use App\OriginModels\Members\MembersModel;

//수강생
class ClassUserModel extends BaseModel
{
    protected $table = 'lms_class_user';

    public function member(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(MembersModel::class, 'user_id', 'user_id');
    }

    public function class(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ClassModel::class, 'class_id', 'class_id');
    }
}
