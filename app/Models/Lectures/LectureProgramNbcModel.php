<?php


namespace App\Models\Lectures;


use App\Models\Common\BaseModel;

class LectureProgramNbcModel extends BaseModel
{
    protected $table = 'lecture_program_nbc';

    public function lectureProgram(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(LectureProgramModel::class);
    }
}
