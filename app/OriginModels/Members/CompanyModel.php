<?php

namespace App\OriginModels\Members;

use App\OriginModels\Common\BaseCodeModel;

class CompanyModel extends BaseCodeModel
{
    protected $table = 'lms_company';
    protected $primaryKey = 'co_id';
}
