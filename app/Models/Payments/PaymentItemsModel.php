<?php


namespace App\Models\Payments;


use App\Models\Common\BaseModel;
use App\Models\Lectures\LectureProgramModel;

class PaymentItemsModel extends BaseModel
{
    protected $table = 'payment_items';
    protected $with = ['lectureProgram'];

    public function payment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(PaymentsModel::class);
    }

    public function lectureProgram(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(LectureProgramModel::class);
    }

}
