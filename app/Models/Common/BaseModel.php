<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class BaseModel extends \LaravelSupports\Models\Common\BaseModel
{
    use SoftDeletes;

    protected $primaryKey = 'idx';

    public function getTable(): string
    {
        return $this->table ?? Str::snake(Str::pluralStudly($this->getTableName()));
    }

    public function getForeignKey(): string
    {
        return Str::snake(Str::of($this->getTableName())->singular() . '_' . $this->getKeyName());
    }

    protected function getTableName(): \Illuminate\Support\Stringable
    {
        return Str::of(class_basename($this))->replace('Model', '');
    }

}
