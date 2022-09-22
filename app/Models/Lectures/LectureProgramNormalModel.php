<?php


namespace App\Models\Lectures;


use App\Models\Common\BaseModel;
use App\Models\Members\MemberLectureProgramModel;
use App\Models\Members\MembersModel;
use App\Models\Payments\PaymentsModel;

class LectureProgramNormalModel extends BaseModel
{
    protected $table = 'lecture_program_normal';

    public function lectureProgram(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(LectureProgramModel::class);
    }

}
