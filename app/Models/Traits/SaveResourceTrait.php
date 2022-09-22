<?php

namespace App\Models\Traits;

use App\Models\Common\ResourcesModel;
use LaravelSupports\Models\Resources\Contracts\ResourceContract;

trait SaveResourceTrait
{
    public function saveResource(string $origin, ?string $name = null): ResourceContract
    {
        return ResourcesModel::createModel($this->getResourcePath(), $origin, $name);
    }

}
