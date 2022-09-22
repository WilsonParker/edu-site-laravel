<?php


namespace App\Models\Members;


use App\Models\Common\BaseModel;
use App\Models\Traits\BelongsToMemberTrait;
use LaravelSupports\Libraries\Supports\Objects\Traits\Bindable;

class MemberInformationModel extends BaseModel
{
    use BelongsToMemberTrait, Bindable;

    protected $table = 'member_information';

}
