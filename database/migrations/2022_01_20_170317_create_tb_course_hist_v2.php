<?php

use Illuminate\Database\Schema\Blueprint;

class CreateTbCourseHistV2 extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected bool $timestamp = false;
    protected bool $softDelete = false;

    /*
     * 과정 이력
     * 훈련기관의 교육시스템에 등록되는 과정정보를 저장한다.
     * 과정 정보는 등록, 수정, 삭제 될 때 마다 기록되도록 trigger가 작성되어야 한다.
     * */
    protected string $table = 'tb_course_hist_v2';

    /**
     * Run the migrations.
     *
     * @return void
     */
     protected function defaultUpTemplate(Blueprint $table)
     {
         $table->unsignedInteger('seq')->autoIncrement()->comment('순번');
         $table->string('course_agent_pk', 150)->nullable(false)->comment('과정 정보의 PK / Lectures');
         $table->string('name', 200)->nullable(false)->comment('과정명');
         $table->string('total_edu_time', 20)->nullable(false)->comment('총교육기간, 개월 또는 시간 단위로 환산된 값 저장, 월 단위로 관리하는 경우 2H, 3M) 같이 저장');
         $table->string('simsa_code', 200)->nullable(false)->comment('심사과정코드, 직업능력심사평가원 원격훈련심사센터를 통해 발급된 심사과정코드 저장');
         $table->boolean('valid_flag')->nullable(false)->comment('유효 여부, 임시 또는 삭제 과정이 아닌 실제로 운영 중이거나 운영했던 과정을 의미');
         $table->boolean('post_course_flag')->nullable(false)->comment('우편과정여부, 우편과정은 1, 우편이 아닌 과정은 (인터넷, 스마트폰 훈련 등) 0 으로 저장');
         $table->enum('change_state', ['C', 'U', 'D'])->nullable(false)->comment('변경 상태, [C:등록, U:수정, D:삭제]');
         $table->timestamp('reg_date')->nullable(false)->useCurrent()->comment('등록 일시');
         $table->string('tracse_id', 50)->nullable(false)->comment('HRD-Net 과정 코드, HRD-Net 에 과정 인정시 생성된 훈련과정 ID 17자리');
     }

}
