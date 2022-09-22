<?php

namespace App\OriginModels\Members;

use App\OriginModels\Common\BaseCodeModel;

class TutorModel extends BaseCodeModel
{
    protected $table = 'lms_tutor';
    protected $primaryKey = 'tu_id';
}
