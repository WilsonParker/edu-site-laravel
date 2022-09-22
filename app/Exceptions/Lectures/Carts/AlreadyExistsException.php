<?php

namespace App\Exceptions\Lectures\Carts;

class AlreadyExistsException extends CartsException
{
    protected $code = 'LT_CT_ST_Already';
    protected $message = '이미 추가된 강의 입니다.';
}
