<?php

namespace App\Models\Traits;

use App\Models\Common\ResourcesModel;

trait ResourceTrait
{

    public function resource(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(ResourcesModel::class, 'resourceable');
    }

    public function resources(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(ResourcesModel::class, 'resourceable');
    }

}
