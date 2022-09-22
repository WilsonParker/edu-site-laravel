<?php

namespace Tests\Unit\Hrd;

use App\Export\HrdListExport;
use App\Models\Hrd\HrdDataModel;
use App\Services\Hrd\HrdBusinessService;
use App\Services\Hrd\HrdJobSeekerService;
use App\Services\Hrd\HrdWorkerService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;

class HrdTest extends TestCase
{
    // use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testInsertAndExcel()
    {
        ini_set('memory_limit', '-1');
        HrdDataModel::truncate();
        $format = 'Ymd';
        $start = new Carbon('20211101');
        $end = new Carbon('20211231');

        $current = $start->copy();
//         $service = new HrdWorkerService();
        $service = new HrdBusinessService();
//        $service = new HrdJobSeekerService();

        do {
            $last = $current->copy()->endOfMonth();
            dump($current->format($format) . ' ~ ' . $last->format($format));

            $service
                ->setPageNum(1)
                ->setPageSize(100)
                ->setTrainingStartDate($current->format($format))
                ->setTrainingEndDate($last->format($format));
            do {
                $service->callListAPI();
                $response = $service->getResult();
                collect($response->items)->each(function ($item) {
                    HrdDataModel::create($this->snake_keys($item->toArray()));
                });
                $service->addPageNum();
            } while ($response->getCount() > $service->getPageNum() * $service->getPageSize());

            $current->addMonth();
        } while ($current->lessThan($end));

        $models = HrdDataModel::all();
        Excel::store(new HrdListExport($models), $service->getFileName($start, $end));
        $this->assertTrue(true);
    }

    public function testExcel()
    {
        ini_set('memory_limit', '-1');
        // $models = HrdDataModel::where('sub_title', '=', '에듀퓨어')->get();
        $models = HrdDataModel::all();
//        Excel::store(new HrdListExport($models), "hrd_worker_data.xlsx");
         Excel::store(new HrdListExport($models), "근로자 20200101_20211031.xlsx");
    }

    function camel_keys($array)
    {
        $result = [];
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $value = camel_keys($value);
            }
            $result[camel_case($key)] = $value;
        }
        return $result;
    }

    public function snake_keys($array, $delimiter = '_')
    {
        $result = [];
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $value = $this->snake_keys($value, $delimiter);
            }
            $snake = $this->snake_case($key, $delimiter);
            $result[$snake] = $value;
        }
        return $result;
    }

    public function snake_case($key, $delimiter): string
    {
        return Str::of($key)->snake($delimiter);
    }
}
