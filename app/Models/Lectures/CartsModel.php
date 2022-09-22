<?php


namespace App\Models\Lectures;


use App\Models\Common\BaseModel;

class CartsModel extends BaseModel
{
    protected $table = 'carts';

    public function lecture(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(LecturesModel::class, 'idx', 'lecture_idx');
    }
}
