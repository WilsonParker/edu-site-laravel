<?php

use Illuminate\Database\Schema\Blueprint;

class CreateLectures extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'lectures';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedInteger('idx')->autoIncrement()->comment('고유키');
        $table->unsignedSmallInteger('lecture_company_idx')->nullable(false)->comment('강의 개발 업체 고유키 참조');
        $table->tinyText('title')->nullable(false)->comment('제목');
        $table->enum('learning_term_type', ['years', 'months', 'weeks', 'days'])->nullable(false)->comment('학습기간유형');
        $table->unsignedTinyInteger('learning_term')->nullable(false)->comment('학습기간');
        $table->unsignedTinyInteger('total_learning_time')->nullable(false)->comment('총 학습 시간');
        $table->unsignedTinyInteger('recognition_time')->nullable(false)->comment('인정 시간');
        $table->text('course_introduction')->nullable(false)->comment('과정 소개');
        $table->text('learning_target')->nullable(false)->comment('학습 대상');
        $table->text('learning_objectives')->nullable(false)->comment('학습 목표');
        $table->unsignedTinyInteger('exam_reflection_rate')->nullable(false)->comment('시험 반영율 (%)');
        $table->unsignedTinyInteger('problem_reflection_rate')->nullable(false)->comment('과제 반영율 (%)');
        $table->unsignedTinyInteger('evaluation_reflection_rate')->nullable(false)->comment('진행 평가 반영율 (%)');
        $table->unsignedSmallInteger('content_width')->nullable(false)->comment('콘텐츠 가로 크기 (px)');
        $table->unsignedSmallInteger('content_height')->nullable(false)->comment('콘텐츠 세로 크기 (px)');
        $table->string('sample_url', 256)->nullable(false)->comment('미리보기 영상 주소');
        $table->string('sample_mobile_url', 256)->nullable(false)->comment('모바일 미리보기 영상 주소');
        $table->unsignedTinyInteger('step_in_progress')->nullable(false)->comment('진행 단계 수');
        $table->unsignedInteger('price')->nullable(false)->comment('정가');
        $table->enum('adjustment_factor', ['0', '0.5', '0.6', '0.7', '0.8', '0.9', '1'])->nullable(false)->comment('지원율 조정계수 (0.5 ~ 1)');
        $table->unsignedInteger('refund_over')->nullable(false)->comment('환급액 (대기업 1000인 이상) 콘텐츠 지원금 기준금액 * 조정계수 * 0.4');
        $table->unsignedInteger('refund_less')->nullable(false)->comment('환급액 (대기업 1000인 미만) 콘텐츠 지원금 기준금액 * 조정계수 * 0.8');
        $table->unsignedInteger('refund_support')->nullable(false)->comment('환급액 (우선 지원) 콘텐츠 지원금 기준금액 * 조정계수 * 0.9');
        $table->unsignedInteger('worker_subsidy')->nullable(false)->comment('근로자 지원금');
        $table->unsignedInteger('tuition')->nullable(false)->comment('수강료');
        $table->unsignedSmallInteger('restriction')->nullable(false)->comment('수강 인원 제한');
        $table->enum('grade', ['A', 'B', 'C'])->nullable(true)->comment('등급');
        $table->timestamp('start_date')->nullable(false)->useCurrent()->comment('강의수강 시작일');
        $table->timestamp('end_date')->nullable(false)->useCurrent()->comment('강의 수강 종료일');
        $table->boolean('is_public')->default(true)->nullable(false)->comment('강의 표시 여부');
        $table->unsignedBigInteger('image_idx')->nullable(true)->comment('이미지 (리소스 참조)');
        $table->unsignedBigInteger('study_material_idx')->nullable(true)->comment('학습 자료 (리소스 참조)');

        $table->string('hrd_url', 256)->nullable(true)->comment('hrd url');
        $table->string('hrd_code', 256)->nullable(true)->comment('HRD 과정 코드');
        $table->string('hrd_code_second', 256)->nullable(true)->comment('HRD 과정 코드');

        $table->foreign('lecture_company_idx')->on('lecture_companies')->references('idx')->cascadeOnUpdate();
        $table->foreign('image_idx')->on('resources')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();
        $table->foreign('study_material_idx')->on('resources')->references('idx')->cascadeOnUpdate()->cascadeOnDelete();
    }

}


