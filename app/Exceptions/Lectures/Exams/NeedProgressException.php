<?php

namespace App\Exceptions\Lectures\Exams;

class NeedProgressException extends ExamException
{
    protected $code = 'LT_EX_NC';
    protected $message = '강의를 수강하셔야 합니다.';
}
