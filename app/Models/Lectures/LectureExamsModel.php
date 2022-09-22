<?php


namespace App\Models\Lectures;


use App\Models\Common\BaseModel;
use App\Models\Common\ResourcesModel;
use App\Models\Traits\ResourceTrait;

class LectureExamsModel extends BaseModel
{
    use ResourceTrait;

    protected $table = 'lecture_exams';

    public function lecture(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(LectureExamsModel::class);
    }

    public function lectureExamSubmits(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(LectureExamSubmitsModel::class);
    }

    public function attachment(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ResourcesModel::class, 'idx', 'attachment_idx');
    }

    public function commentary(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ResourcesModel::class, 'idx', 'commentary_idx');
    }

    public function answer(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ResourcesModel::class, 'idx', 'answer_idx');
    }
}
