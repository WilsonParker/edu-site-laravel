<?php

namespace App\Services\Payments\Contracts;

/**
 * 결제 정보를 저장할 Model 에 사용합니다
 *
 * @author  dev9163
 * @added   2021/10/20
 * @updated 2021/10/20
 */
interface Payment
{
    public function getCode(): string;

}
