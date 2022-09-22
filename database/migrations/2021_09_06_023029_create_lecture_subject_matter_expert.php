<?php

use Illuminate\Database\Schema\Blueprint;

class CreateLectureSubjectMatterExpert extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'lecture_subject_matter_expert';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedInteger('idx')->autoIncrement()->comment('고유키');
        $table->unsignedInteger('lecture_idx')->nullable(false)->comment('강의 고유키 참조');
        $table->unsignedInteger('subject_matter_expert_idx')->nullable(false)->comment('내용 전문가 고유키 참조');

        $table->foreign('lecture_idx')->on('lectures')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();
        $table->foreign('subject_matter_expert_idx')->on('subject_matter_expert')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();
    }

}
