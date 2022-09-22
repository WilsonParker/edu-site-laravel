<?php

namespace App\Exceptions\Lectures\Exams;

class AlreadySubmitExamException extends ExamException
{
    protected $code = 'LT_EX_already_submit';
    protected $message = '이미 제출한 시험 입니다.';
}
