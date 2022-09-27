<?php

namespace App\Services\Payments;

use App\Models\Payments\PaymentItemsModel;
use App\Models\Payments\PaymentsModel;
use App\Services\Payments\Contracts\Payable;
use App\Services\Payments\Contracts\PayableMember;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use LaravelSupports\Libraries\Codes\Abstracts\AbstractCodeGenerator;

class PaymentService extends AbstractCodeGenerator
{
    protected array $ready = [];

    /**
     *
     * @param Collection|Payable $data
     * @param PayableMember $member
     * @param string $method
     * card : 카드 결제
     * vbank : 가상 계좌 결제
     * trans : 실시간 계좌이체
     * @author  dev9163
     * @added   2021/10/20
     * @updated 2021/10/20
     */
    public function __construct(protected Collection|Payable $data, protected PayableMember $member, protected string $method)
    {

    }

    public function ready(): array
    {
        $this->ready = [
            'pg' => 'html5_inicis',
            'pay_method' => $this->method,
            'name' => $this->getTitle(),
            'amount' => $this->getAmount(),
            'buyer_email' => $this->member->getEmail(),
            'buyer_name' => $this->member->getName(),
            'buyer_tel' => $this->member->getContact(),
            'buyer_addr' => $this->member->getAddress(),
            'buyer_postcode' => $this->member->getZipCode(),
            'm_redirect_url' => '',
        ];
        $this->beforeReady();
        return $this->ready;
    }

    public function getTitle(): string
    {
        if ($this->data instanceof Collection) {
            $count = $this->data->count() - 1;
            if ($count == 0) {
                return $this->data->first()->getTitle();
            } else {
                return "{$this->data->first()->getTitle()} 외 {$count}건";
            }
        } else {
            return $this->data->getTitle();
        }
    }

    protected function getAmount(): int
    {
        return 10;
        if ($this->data instanceof Collection) {
            return $this->data->sum(fn($item) => $item->getPrice());
        } else {
            return $this->data->getPrice();
        }
    }

    public function createCode(): string
    {
        return 'study-laravel-project_' . now()->format('ymd') . '_' . Str::random(16);
    }

    protected function beforeReady()
    {
        $paymentModel = new PaymentsModel();
        $this->generateCode($paymentModel);
        $this->ready['merchant_uid'] = $paymentModel->request_id;
        $paymentModel->member_idx = $this->member->getPrimaryValue();
        $paymentModel->payment_method_code = $this->method;
        $paymentModel->status = 'ready';
        $paymentModel->name = $this->ready['name'];
        $paymentModel->price = $this->ready['amount'];
        $paymentModel->save();

        $this->data = $this->data instanceof Collection ? $this->data : collect([$this->data]);
        $this->data->each(function ($item) use ($paymentModel) {
            PaymentItemsModel::create([
                'payment_idx' => $paymentModel->getPrimaryValue(),
                'lecture_program_idx' => $item->getPrimaryValue(),
                'status' => 'ready',
                'price' => $item->getPrice(),
            ]);
        });
    }


}
