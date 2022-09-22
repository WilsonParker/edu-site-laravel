<?php


namespace App\Services\Hrd;


/**
 * 기업 훈련 과정 API
 * @author  dev9163
 * @added   2021/10/08
 * @updated 2021/10/08
 */
class HrdBusinessService extends BaseHrdService
{
    protected string $name = '기업';
    /*
     * 'C0041' : 사업주지원
     * 'C0042' : 컨소시엄
     * */
    protected string $trainingType = 'C0041';

    /*
     * '1' : 집체(집합)과정
     * '2' : 인터넷과정
     * '3' : 우편과정
     * '4' : 혼합과정
     * '5' : 스마트과정
     * 전체일 경우에는 옵션 파라미터의 미등록처리
     * */
    protected string $trainingGbn = '2';
    protected string $trainingOrganName = '';

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
            'crseTracseSe' => $this->trainingType,
            'srchTraGbn' => $this->trainingGbn,
            'srchTraStDt' => $this->trainingStartDate,
            'srchTraEndDt' => $this->trainingEndDate,
        ];
    }

    protected function getListUrl(): string
    {
        return $this->getUrl() . '/jsp/HRDP/HRDPO00/HRDPOA62/HRDPOA62_1.jsp';
    }

}
