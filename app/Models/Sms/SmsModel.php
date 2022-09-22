<?php


namespace App\Models\Sms;


use App\Models\Common\BaseModel;
use App\Models\Members\MembersModel;

class SmsModel extends BaseModel
{
    protected $table = 'sms';

    public function member(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MembersModel::class);
    }
}
