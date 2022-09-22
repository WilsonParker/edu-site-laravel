<?php

namespace App\Models\Traits;

use App\Models\Lectures\LecturesModel;

trait HasManyLecturesTrait
{
    public function lectures(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(LecturesModel::class);
    }
}
