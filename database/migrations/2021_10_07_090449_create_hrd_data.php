<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrdData extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'hrd_data';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedInteger('idx')->autoIncrement()->comment('고유키');

        $table->string('training_gbn', 32)->nullable(true)->default('')->comment('과정 구분');
        $table->string('address', 32)->nullable(true)->default('')->comment('주소');
        $table->string('contents', 128)->nullable(true)->default('')->comment('컨텐츠');
        $table->string('course_man', 16)->nullable(true)->default('')->comment('수강비');
        $table->string('grade', 1)->nullable(true)->default('')->comment('등급');
        $table->string('img_gubun', 8)->nullable(true)->default('')->comment('제목 아이콘 구분');
        $table->string('inst_cd', 16)->nullable(true)->default('')->comment('훈련기관 코드');
        $table->string('ncs_cd', 16)->nullable(true)->default('')->comment('NCS 코드');
        $table->string('real_man', 8)->nullable(true)->default('')->comment('실제 훈련비');
        $table->string('reg_course_man', 8)->nullable(true)->default('')->comment('수강신청 인원');
        $table->string('sub_title', 128)->nullable(true)->default('')->comment('부 제목');
        $table->string('sub_title_link', 128)->nullable(true)->default('')->comment('부 제목 링크');
        $table->string('super_viser', 32)->nullable(true)->default('')->comment('주관 부처');
        $table->string('tel_no', 16)->nullable(true)->default('')->comment('전화번호');
        $table->string('title', 128)->nullable(true)->default('')->comment('제목');
        $table->string('title_icon', 128)->nullable(true)->default('')->comment('제목 아이콘');
        $table->string('title_link', 128)->nullable(true)->default('')->comment('제목 링크');
        $table->string('tra_end_date', 16)->nullable(true)->default('')->comment('훈련 종료 일자');
        $table->string('tra_start_date', 16)->nullable(true)->default('')->comment('훈련 시작 일자');
        $table->string('train_target', 16)->nullable(true)->default('')->comment('훈련 대상');
        $table->string('train_target_cd', 8)->nullable(true)->default('')->comment('훈련 구분');
        $table->string('trainst_cst_id', 32)->nullable(true)->default('')->comment('훈련 기관 ID');
        $table->string('trpr_degr', 8)->nullable(true)->default('')->comment('훈련 과정 순차');
        $table->string('trpr_id', 32)->nullable(true)->default('')->comment('훈련 과정 ID');
        $table->string('yard_man', 8)->nullable(true)->default('')->comment('정원');

        $table->index('training_gbn');
        $table->index('inst_cd');
        $table->index('train_target_cd');
        $table->index('trpr_id');
        $table->index('sub_title');
    }

}
