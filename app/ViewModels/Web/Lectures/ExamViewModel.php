<?php

namespace App\ViewModels\Web\Lectures;

use App\Models\Lectures\ExamType;
use App\Models\Members\MemberExamsModel;
use App\Models\Members\MemberLectureProgramModel;
use App\Models\Members\MembersModel;
use App\ViewModels\Common\BaseViewModel;

class ExamViewModel extends BaseViewModel
{
    protected string $dateFormat = 'Y-m-d';
    public int $examCount = 0;
    public string $type = '';
    public ?MembersModel $member = null;
    public ?MemberExamsModel $exam = null;
    public ?MemberLectureProgramModel $program = null;

    protected function init()
    {
    }

    public function checkType(ExamType|array $type): bool
    {
        if (!$type instanceof ExamType) {
            return collect($type)->reduce(function ($carry, $item) {
                return $carry || ($this->data->exam->exam_type == $item->value);
            }, false);
        }
        return $this->data->exam->exam_type == $type->value;
    }
}
