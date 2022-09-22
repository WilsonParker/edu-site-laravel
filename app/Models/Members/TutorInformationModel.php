<?php


namespace App\Models\Members;


use App\Models\Common\BaseModel;
use App\Models\Traits\BelongsToMemberTrait;

class TutorInformationModel extends BaseModel
{
    use BelongsToMemberTrait;

    protected $table = 'tutor_information';

}
