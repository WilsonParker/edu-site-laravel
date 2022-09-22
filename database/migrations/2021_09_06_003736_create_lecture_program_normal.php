<?php

use Illuminate\Database\Schema\Blueprint;

class CreateLectureProgramNormal extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'lecture_program_normal';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedInteger('idx')->autoIncrement()->comment('고유키');
        $table->unsignedInteger('lecture_program_idx')->nullable(false)->comment('강의 운영 과정 참조');
        $table->unsignedMediumInteger('tuition')->default(0)->nullable(false)->comment('수강료');
        $table->boolean('is_apply')->default(false)->nullable(false)->comment('고용보험 적용 여부(비환급 50% 미적용, 비환급 50% 적용)');

        $table->foreign('lecture_program_idx')->on('lecture_program')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();
    }

}
