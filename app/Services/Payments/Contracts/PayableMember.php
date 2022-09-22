<?php

namespace App\Services\Payments\Contracts;

/**
 * 결제를 할 Model 에 사용합니다
 *
 * @author  dev9163
 * @added   2021/10/20
 * @updated 2021/10/20
 */
interface PayableMember
{
    public function getEmail(): string;

    public function getName(): string;

    public function getContact(): string;

    public function getAddress(): string;

    public function getZipCode(): string;

}
