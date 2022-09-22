<?php

namespace App\Models\Site;

use App\Models\Common\ResourceableModel;

class BannersModel extends ResourceableModel
{
    protected $table = 'banners';

    public function type(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(BannerTypesModel::class);
    }

    public function getResourcePath(): string
    {
        return '/banner';
    }
}
