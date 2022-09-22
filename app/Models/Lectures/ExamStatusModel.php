<?php


namespace App\Models\Lectures;


use App\Models\Common\BaseCodeModel;
use App\Models\Payments\EncourageSmsModel;

class ExamStatusModel extends BaseCodeModel
{
    protected $table = 'exam_status';

    public function encourageSms(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(EncourageSmsModel::class);
    }
}
