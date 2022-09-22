<?php

namespace App\OriginModels\Common;

use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends \LaravelSupports\Models\Common\BaseModel
{
    protected $connection = 'origin';
    public $timestamps = false;
    protected $primaryKey = 'idx';

}
