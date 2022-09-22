<?php

namespace App\Models\Site;

use App\Models\Common\BaseCodeModel;

class BannerTypesModel extends BaseCodeModel
{
    protected $table = 'banner_types';

    public function banners(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(BannersModel::class);
    }
}
