<?php

namespace App\Services\Payments\Contracts;

/**
 * 결제가 가능한 Model 에 사용합니다
 *
 * @author  dev9163
 * @added   2021/10/20
 * @updated 2021/10/20
 */
interface Payable
{
    public function getTitle(): string;

    public function getPrice(): int;

}
