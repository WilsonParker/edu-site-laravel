<?php

namespace App\Exceptions\Lectures;

class NotValidLectureException extends \Exception
{
    protected $code = 'LT_NV_not_valid';
    protected $message = '수강할 수 없는 강의 입니다.';
}
