<?php


namespace App\Models\Members;

use App\Models\Common\BaseModel;
use LaravelSupports\Libraries\Supports\Objects\Traits\Bindable;

class MemberPushModel extends BaseModel
{
    use Bindable;

    protected $table = 'member_push';

    public function memberType(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MemberTypesModel::class);
    }
}
