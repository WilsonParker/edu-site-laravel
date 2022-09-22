<?php


namespace App\Models\Sms;


use App\Models\Common\BaseCodeModel;
use App\Models\Lectures\MemberLectureCardinalNumbersModel;

class EncourageStatusModel extends BaseCodeModel
{
    protected $table = 'encourage_status';

    public function encourageContents()
    {
        return $this->hasMany(EncourageContentsModel::class);
    }
}
