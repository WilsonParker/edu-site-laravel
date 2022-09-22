<?php


namespace App\Services\Hrd;


/**
 * 구직자 훈련 과정 API
 * @author  dev9163
 * @added   2021/11/03
 * @updated 2021/11/03
 */
class HrdJobSeekerService extends BaseHrdService
{
    protected string $name = '구직자';

    /*
     * 'C0055' : 내일배움카드(구직자)
     * 'C0054' : 국가기간전략산업직종
     * 'C0068' : 컨소시 엄 채용예정자
     * 'C0053' : 지역구직자
     * 'C0059' : 청년취업아카데미
     * 'Y0054' : 4차산업혁명인력양성
     * 'Z' : 중장년특화과정
     * 'C0077' : 지역맞춤형일자리창출지원
     * 'C0074' : 장애인직업능력개발훈련
     * 'C0075' : 건설일용근로자기능향상
     * 'C0071' : 베이비부머과정(폴리텍대학)
     * 'C0069' : 기능사과정(폴리텍대학)
     * 'C0070' : 기능장과정(폴리텍대학)
     * 'C0072' : 여성재취업과정(폴리텍대학)
     * 전체일 경우에는 옵션 파라미터의 미등록처리
     * */
    protected string $crseTracseSe = 'C0055';

    /*
     * '00' : 일반과정
     * '01' : 취약계층특화과정
     * '50' : 인터넷과정
     * '51' : 혼합과정(BL)
     * 전체일 경우에는 옵션 파라미터의 미등록처리
     * */
    protected string $trainingGbn = '';

    protected function initParam()
    {
        $this->param = [
            'authKey' => $this->authKey,
            'returnType' => 'XML',
            'outType' => $this->outType,
            'pageNum' => $this->pageNum,
            'pageSize' => $this->pageSize,
            'sort' => $this->sort,
            'sortCol' => $this->sortCol,
            'crseTracseSe' => $this->crseTracseSe,
            'srchTraGbn' => $this->trainingGbn,
            'srchTraStDt' => $this->trainingStartDate,
            'srchTraEndDt' => $this->trainingEndDate,
        ];
    }

    protected function getListUrl(): string
    {
        return $this->getUrl() . '/jsp/HRDP/HRDPO00/HRDPOA60/HRDPOA60_1.jsp';
    }

}
