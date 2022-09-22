<?php


namespace App\Models\Lectures;


use App\Models\Common\ResourceableModel;
use App\Models\Common\ResourcesModel;

class LectureBooksModel extends ResourceableModel
{
    protected $table = 'lecture_books';

    public function lecture(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(LecturesModel::class);
    }

    public function image(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ResourcesModel::class, 'idx', 'image_idx');
    }

    public function getResourcePath(): string
    {
        return '/lecture/book';
    }

}
