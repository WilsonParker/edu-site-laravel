<?php

namespace App\Mail\Payments;


use App\Mail\BaseMail;

class PaymentCompleted extends BaseMail
{
    protected string $receiverGroup = 'book';

    /**
     * @inheritDoc
     */
    protected function getViewString() : string
    {
        return 'emails.orders_completed';
    }

    /**
     * @inheritDoc
     */
    protected function getSubjectString() : string
    {
        return $this->data->receiver_name . '님이 책을 결제하셨습니다.';
    }

}
