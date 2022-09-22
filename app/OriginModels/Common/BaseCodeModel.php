<?php

namespace App\OriginModels\Common;

use Illuminate\Database\Eloquent\SoftDeletes;

class BaseCodeModel extends \LaravelSupports\Models\Common\BaseModel
{
    protected $connection = 'origin';
    public $timestamps = false;
    public $keyType = "string";
    protected $primaryKey = 'id';

}
