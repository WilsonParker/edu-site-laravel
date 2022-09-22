<?php


namespace App\Models\Payments;


use App\Models\Common\BaseModel;
use App\Models\Coupons\CouponsModel;
use App\Models\Lectures\LectureProgramModel;
use App\Models\Members\MembersModel;
use LaravelSupports\Libraries\Codes\Contracts\GenerateCode;

class PaymentsModel extends BaseModel implements GenerateCode
{
    protected $table = 'payments';
    protected $with = ['method', 'paymentItems', 'member'];

    public function member(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MembersModel::class);
    }

    public function lectureCardinalNumber(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(LectureProgramModel::class);
    }

    public function coupon(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(CouponsModel::class);
    }

    public function paymentItems(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(PaymentItemsModel::class);
    }

    public function method(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(PaymentMethodsModel::class, 'payment_method_code', 'code');
    }

    public function lecturePrograms(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(LectureProgramModel::class, PaymentItemsModel::class);
    }

    public function getPaidStatusString(): string
    {
        return match ($this->status) {
            'ready' => '결제대기',
            'paid' => '결제완료',
            'cancel' => '결제취소',
            'fail' => '결제에러',
            default => "관리자에게 문의하세요",
        };
    }

    public function isExists($code): bool
    {
        return $this->where('request_id', $code)->exists();
    }

    public function setCode($code)
    {
        $this->request_id = $code;
    }
}
