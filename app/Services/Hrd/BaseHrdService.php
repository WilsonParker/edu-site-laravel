<?php


namespace App\Services\Hrd;


use App\Services\Hrd\Model\HrdResponseModel;
use Carbon\Carbon;
use GuzzleHttp\Client;

abstract class BaseHrdService
{
    protected string $url = 'https://www.hrd.go.kr';
    protected string $authKey = 'xoDHzdUMoTKFrtHZUTJciZVp4rzAleto';
    protected string $name = '';
    protected array $param = [];
    protected int $pageNum = 1;
    protected int $pageSize = 10;

    /*
     * '1' : 리스트
     * '2' : 상세
     * */
    protected string $outType = '1';

    /*
     * ASC | DESC
     * */
    protected string $sort = 'ASC';

    /*
     * 모집인원 : "TOT_FXNUM",
     * 훈련시작일 : "TR_STT_DT",
     * 훈련과정명 : "TR_NM_i"
     * */
    protected string $sortCol = 'TR_STT_DT';

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
    protected string $trainingStartDate = '';
    protected string $trainingEndDate = '';
    protected Client $client;
    protected HrdResponseModel $result;

    public function __construct()
    {
        $this->init();
    }

    protected function init()
    {
        $this->client = new Client();
    }

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

    protected function beforeHttp()
    {
        $this->initParam();
    }

    public function callListAPI()
    {
        $this->beforeHttp();
        $response = $this->client->get($this->getListUrl(), [
            'query' => $this->param
        ]);
        $xml = simplexml_load_string($response->getBody(), 'SimpleXMLElement', LIBXML_NOCDATA);
        $json = json_encode($xml);
        $array = json_decode($json, TRUE);
        $this->setResult($array);
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getPageNum(): int
    {
        return $this->pageNum;
    }

    public function getPageSize(): int
    {
        return $this->pageSize;
    }

    public function getResult(): HrdResponseModel
    {
        return $this->result;
    }

    public function addPageNum(): static
    {

        $this->setPageNum($this->getPageNum() + 1);
        return $this;
    }

    public function setPageNum(int $pageNum): static
    {
        $this->pageNum = $pageNum;
        return $this;
    }

    public function setPageSize(int $pageSize): static
    {
        $this->pageSize = $pageSize;
        return $this;
    }

    public function setDetail(bool $isDetail): static
    {
        $this->outType = $isDetail ? '2' : '1';
        return $this;
    }

    public function setTrainingType(string $trainingType): static
    {
        $this->trainingType = $trainingType;
        return $this;
    }

    public function setSortAsc(): static
    {
        $this->sort = 'ASC';
        return $this;
    }

    public function setSortDesc(): static
    {
        $this->sort = 'DESC';
        return $this;
    }

    public function setSortCol(string $sortCol): static
    {
        $this->sortCol = $sortCol;
        return $this;
    }

    public function setTrainingGbn(string $trainingGbn): static
    {
        $this->trainingGbn = $trainingGbn;
        return $this;
    }

    public function setTrainingStartDate(string $trainingStartDate): static
    {
        $this->trainingStartDate = $trainingStartDate;
        return $this;
    }

    public function setTrainingEndDate(string $trainingEndDate): static
    {
        $this->trainingEndDate = $trainingEndDate;
        return $this;
    }

    /**
     * @param mixed $result
     */
    public function setResult($result)
    {
        $this->result = new HrdResponseModel($result, $this->trainingOrganName, $this->trainingGbn);
    }

    public function getFileName(Carbon $start, Carbon $end) : string{
        $format = 'Y-m-d';
        return "$this->name {$start->format($format)}~{$end->format($format)}.xlsx";
    }

    abstract protected function getListUrl(): string;
}
