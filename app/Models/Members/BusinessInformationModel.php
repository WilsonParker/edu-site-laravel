<?php


namespace App\Models\Members;


use App\Models\Common\BaseModel;
use App\Models\Traits\BelongsToMemberTrait;

class BusinessInformationModel extends BaseModel
{
    use BelongsToMemberTrait;

    protected $table = 'business_information';

}
