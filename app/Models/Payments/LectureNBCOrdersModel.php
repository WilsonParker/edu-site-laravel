<?php


namespace App\Models\Payments;


use App\Models\Common\BaseModel;
use App\Models\Lectures\NBCTypesModel;
use App\Models\Traits\BelongsToMemberTrait;

class LectureNBCOrdersModel extends BaseModel
{
    use BelongsToMemberTrait;

    protected $table = 'lecture_nbc_orders';

    public function nbcType(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(NBCTypesModel::class);
    }

    public function payment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(PaymentsModel::class);
    }
}
