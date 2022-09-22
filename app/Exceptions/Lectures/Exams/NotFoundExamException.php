<?php

namespace App\Exceptions\Lectures\Exams;

class NotFoundExamException extends ExamException
{
    protected $code = 'LT_EX_NF';
    protected $message = '시험 정보를 불러오지 못했습니다.';
}
