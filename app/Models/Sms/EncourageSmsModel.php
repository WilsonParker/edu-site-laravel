<?php


namespace App\Models\Sms;


use App\Models\Common\BaseModel;
use App\Models\Lectures\ExamStatusModel;
use App\Models\Lectures\LecturesModel;
use App\Models\Lectures\MemberLectureCardinalNumbersModel;

class EncourageSmsModel extends BaseModel
{
    protected $table = 'encourage_sms';

    public function lecture(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(LecturesModel::class);
    }

    public function examStatus()
    {
        return $this->belongsTo(ExamStatusModel::class);
    }
}
