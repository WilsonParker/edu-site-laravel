<?php

namespace App\Models\Traits;

use App\Models\Members\MembersModel;

trait BelongsToMemberTrait
{
    public function member(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MembersModel::class);
    }
}
