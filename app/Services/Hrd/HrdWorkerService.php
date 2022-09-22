<?php


namespace App\Services\Hrd;


/**
 * 근로자 훈련 과정 API
 * @author  dev9163
 * @added   2021/10/08
 * @updated 2021/10/08
 */
class HrdWorkerService extends BaseHrdService
{
    protected string $name = '근로자';

    /*
     * C0031 : 근로자카드
     * C0073 : 영세사업장훈련(폴리텍대학)
     * */
    protected string $crseTracseSe = 'C0031';
    /*
     * '1' : 일반과정
     * '2' : 외국어과정
     * '3' : 인터넷과정
     * 전체일 경우에는 옵션 파라미터의 미등록처리
     * */
    protected string $srchTraGbn = '3';

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
            'srchTraGbn' => $this->srchTraGbn,
            'srchTraStDt' => $this->trainingStartDate,
            'srchTraEndDt' => $this->trainingEndDate,
        ];
    }

    protected function getListUrl(): string
    {
        return $this->getUrl() . '/jsp/HRDP/HRDPO00/HRDPOA61/HRDPOA61_1.jsp';
    }

}
