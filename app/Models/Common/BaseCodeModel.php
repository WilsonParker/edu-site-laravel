<?php

namespace App\Models\Common;

class BaseCodeModel extends BaseModel
{
    protected $primaryKey = 'code';
    protected $keyType = 'string';
    public $incrementing = false;

}
