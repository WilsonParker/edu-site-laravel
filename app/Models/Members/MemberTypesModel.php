<?php


namespace App\Models\Members;


use App\Models\Common\BaseCodeModel;

class MemberTypesModel extends BaseCodeModel
{
    protected $table = 'member_types';

    public function members(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(MembersModel::class);
    }
}
