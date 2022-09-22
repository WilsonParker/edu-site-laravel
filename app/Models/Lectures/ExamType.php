<?php

namespace App\Models\Lectures;

enum ExamType: string
{
    case AUTHENTIC = 'authentic';
    case MULTIPLE = 'multiple';
    case SUBJECTIVE = 'subjective';
    case SHORT = 'short';

}
