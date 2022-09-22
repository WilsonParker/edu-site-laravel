<?php

namespace App\OriginModels\Members;

use App\OriginModels\Common\BaseCodeModel;

//경비지도사 테이블
class JidoModel extends BaseCodeModel
{
    protected $table = 'lms_jido';
    protected $primaryKey = 'jido_id';
}
