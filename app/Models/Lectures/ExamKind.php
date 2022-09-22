<?php

namespace App\Models\Lectures;

enum ExamKind: string
{
    case MIDDLE = 'middle';
    case FINAL = 'final';
    case TASK = 'task';

    public function text(): string
    {
        return match ($this) {
            self::MIDDLE => '진행단계평가',
            self::FINAL => '최종평가',
            self::TASK => '과제',
        };
    }
}
