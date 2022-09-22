<?php

use Illuminate\Database\Schema\Blueprint;

class CreateTbScoreHistV2 extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected bool $timestamp = false;
    protected bool $softDelete = false;

    /*
     * 성적 이력
     * 수강생이 수업을 통해 획득하는 성적에 대한 모든 정보를 저장한다.
     * 즉, 수강자가 최종적으로 획득하게 더되는 점수인 총점이 계산되기 위해 사용한 모든 평가 방법과 그 평가방법으로 획득ㅎ나 점수를 저장한다.ㅈ
     * */
    protected string $table = 'tb_score_hist_v2';

    /**
     * Run the migrations.
     *
     * @return void
     */
    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedInteger('seq')->autoIncrement()->comment('순번');
        $table->string('user_agent_pk', 150)->nullable(false)->comment('훈련기관 회원 PK / Members');
        $table->string('course_agent_pk', 150)->nullable(false)->comment('훈련기관 과정 PK / Lectures');
        $table->string('class_agent_pk', 150)->nullable(false)->comment('훈련기관 수업 PK / Classes');
        $table->string('eval_type', 150)->nullable(false)->comment('평가 방법, [과제_1, 시험_1, 시험_2, 진행평가_1] (평가는 횟수별로 구현), [진도_1, 진도_2] (진도는 차시별로 구분)');
        $table->timestamp('submit_date')->nullable(false)->comment('제출 일시, 평가 방법에 의해 결정, [과제:제출 일시, 시험:제출 일시, 진행평가:제출 일시, 진도:차시별 접속일시, 차시별 종료일시 -> 진도는 차시별 최소 2회 이상 저장]');
        $table->unsignedDecimal('score', 10)->nullable(false)
            ->comment('해당 평가 방법에 의해 수강자가 획득한 환산 점수, LMS 상 시험 100점, 과제 100점, 진행단계평가 100점으로 총점이 300점 일 경우 (평가별 비율은 시험 60%, 과제 30%, 진행단계평가 10%로 관리),
                시험_1 의 점수가 90점인 경우 저장값은 90 * 60% = 54저장, 과제_1 의 점수가 70인 경우 저장값은 70 * 30% = 21로 저장, 진행평가_1 의 점수가 50 인 경우 저장값은 50 * 10% = 5로 저장
                (위 평가의 총합계 80점이 TB_ATTEND_RESULT_HIST 테이블의 총점 TOTAL_SCORE 값과 일치 하여야함');
        $table->string('access_ip', 15)->nullable(false)->comment('접속 IP');
        $table->string('submit_due_dt', 8)->nullable(false)->comment('제출 마감 일');
        $table->enum('change_state', ['C', 'U', 'D'])->nullable(false)->comment('변경 상태, [C:등록, U:수정, D:삭제]');
        $table->enum('is_copied_answer', ['Y', 'N', 'X'])->nullable(false)->comment('모사답안 여부 [Y:모사답안으로 판정, N:모사답안이 아닌 것으로 판정, X:판정 부락, 모사답안 여부의 대상이 아님, 모사답안여부를 판별하지 않음]');
        $table->timestamp('reg_date')->nullable(false)->useCurrent()->comment('등록 일시');
        $table->enum('eval_cd', ['01', '02', '03', '04'])->nullable(false)->comment('평가코드 [01:진도, 02:시험, 03:과제, 04:진행단계평가]');
    }

}
