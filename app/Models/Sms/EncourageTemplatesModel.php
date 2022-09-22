<?php


namespace App\Models\Sms;


use App\Models\Common\BaseCodeModel;

class EncourageTemplatesModel extends BaseCodeModel
{
    protected $table = 'encourage_templates';

    public function encourageStatus(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(EncourageStatusModel::class);
    }
}
