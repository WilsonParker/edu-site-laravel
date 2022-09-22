<?php

namespace App\OriginModels\Lectures;

use App\OriginModels\Common\BaseModel;

// 강의 메모
class NoteModel extends BaseModel
{
    protected $table = 'lms_note';
    protected $primaryKey = 'no';
}
