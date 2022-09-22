<?php

use Illuminate\Database\Schema\Blueprint;

class CreateTbUserHistV2Enc extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected bool $timestamp = false;
    protected bool $softDelete = false;

    /*
     * 회원 정보 이력 암호화
     * (뷰) TB_USER_HIST_V2
     * 훈련기관의 모든 회원정보를 저장한다.
     * */
    protected string $table = 'tb_user_hist_v2_enc';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedInteger('seq')->autoIncrement()->comment('순번');
        $table->string('user_agent_pk', 150)->nullable(false)->comment('훈련기관 회원 PK / Members');
        $table->string('user_name', 100)->nullable(false)->comment('회원 이름');
        $table->string('res_no', 100)->nullable(false)->comment('주민등록번호, "-" 미포함');
        $table->string('enc_res_no', 200)->nullable(false)->comment('수강자 소속, 단체명');
        $table->string('email', 100)->nullable(true)->comment('이메일');
        $table->string('mobile', 50)->nullable(false)->comment('휴대폰 번호, "-" 를 포함, 없는 경우 "-"');
        $table->string('tel', 50)->nullable(true)->comment('연락처, 집 또는 직장 번호 "-" 포함');
        $table->string('post', 10)->nullable(false)->comment('우편번호, 없는 경우 "-"');
        $table->enum('change_state', ['C', 'U', 'D'])->nullable(false)->comment('변경 상태, [C:등록, U:수정, D:삭제]');
        $table->timestamp('reg_date')->nullable(false)->useCurrent()->comment('등록 일시');
        $table->string('nw_ino', 50)->nullable(true)->comment('비용수급사업장, 실시신고시 입려갛는 비용수급 사업장 번호 11자리 "-" 제외, 비용수급사업장 번호와 훈련생 구분을 입력하지 않을 시 훈련생 구분 자사근로자로 인식');
        $table->enum('thnee_se', ['002', '003', '006', '007', '008', '013', '983', '984', '985'])->nullable(true)->comment('훈련생 구분, 미입력시 자사근로자로 인식, 입력시 반드시 비용수급사업장 저장 필요, [002 : 구직자, 003:채용예정자, 006:전직/이직에정자, 007:자사근로자, 008:타사근로자, 013:일용직근로자, 983:일용포함, 984:고용유지훈련, 985:적용제외근로자]');
        $table->enum('irglbr_se', ['000', '012', '013', '014', '020', '021', '022', '987'])->nullable(true)->comment('비정규직 구분, [000:비정규직해당없음 정규직포함, 012:파견근로자, 013:일용근로자, 014:기간제근로자, 020:단기간근로자, 021:무급휴업/휴직자, 022:임의가입자영업자, 987:분류불능]');
    }
}
