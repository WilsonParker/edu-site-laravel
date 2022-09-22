<?php

namespace App\Models\Lectures;

enum ExamStatus: string
{
    case NONE = 'none';
    case WAITING = 'waiting_for_grading';
    case COMPLETE = 'complete_grading';

    public function text(): string
    {
        return match ($this) {
            self::NONE => '미제출',
            self::WAITING => '제출[평가중]',
            self::COMPLETE => '제출[평가완료]',
        };
    }

    public function taskText(): string
    {
        return match ($this) {
            self::NONE => '제출',
            self::WAITING => '결과보기/채점중',
            self::COMPLETE => '결과보기/채점완료',
        };
    }
}
