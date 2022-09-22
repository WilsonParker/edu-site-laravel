<?php

namespace App\Models\Site;

use App\Models\Common\ResourceableModel;

class PopUpModel extends ResourceableModel
{
    protected $table = 'pop_up';

    public function type(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(PopUpTypesModel::class);
    }

    public function getResourcePath(): string
    {
        return '/banner';
    }
}
