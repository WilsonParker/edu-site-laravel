<?php

namespace App\Exceptions\Lectures\Exams;

class EndOfExamException extends ExamException
{
    protected $code = 'LT_EX_end';
    protected $message = '종료된 시험 입니다.';
}
