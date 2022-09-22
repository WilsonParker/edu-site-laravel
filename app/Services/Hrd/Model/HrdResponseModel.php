<?php


namespace App\Services\Hrd\Model;


use App\Services\Hrd\Traits\BindTraits;
use Maatwebsite\Excel\Concerns\ToArray;

class HrdResponseModel
{
    use BindTraits;

    public string $pageNum = '';
    public string $pageSize = '';
    public string $scn_cnt = '';
    public array $items = [];

    /**
     * HrdResponseModel constructor.
     * @param $data
     */
    public function __construct($data, ?string $organization = null, string $trainingGbn = '')
    {
        $this->bindArray($data);
        if(isset($organization) && $organization != '') {
            $data = collect($data['srchList']['scn_list'])->filter(function ($item) use($organization) {
               return $item['subTitle'] == $organization;
            });
        } else {
            $data = $data['srchList']['scn_list'];
        }
        foreach ($data as $item) {
            array_push($this->items, new HrdResponseItemModel($item, $trainingGbn));
        }
    }

    public function getCount(): int
    {
        return $this->scn_cnt;
    }

}
