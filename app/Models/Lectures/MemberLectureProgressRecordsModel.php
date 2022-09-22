<?php


namespace App\Models\Lectures;


use App\Models\Common\BaseModel;
use App\Models\Members\MemberLectureProgramModel;
use App\Models\Members\MembersModel;
use Awobaz\Compoships\Compoships;

class MemberLectureProgressRecordsModel extends BaseModel
{
    use Compoships;

    protected $table = 'member_lecture_progress_records';

    public function lectureClass(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(LectureClassesModel::class);
    }

    public function member(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MembersModel::class);
    }

    public function memberLectureProgram(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MemberLectureProgramModel::class);
    }
}
