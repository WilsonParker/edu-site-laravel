<?php

namespace App\Exceptions\Lectures;

class NeedPreviousProgressException extends \Exception
{
    protected $code = 'LT_NP_previous_progress';
    protected $message = '이전 차시를 수강 완료해야 합니다.';
}
