<?php

namespace Tests\Unit\Members;

use App\Export\CouponUsedListExport;
use App\OriginModels\Coupons\CouponModel;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Arr;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;

class CouponTest extends TestCase
{
    use DatabaseTransactions;

    public function testUsedCouponMembers()
    {
        $code = ['2021nhis2'];
        $code = ['hira2021', 'nhis2021', '2021nhis2', '2021nps'];
        $data = CouponModel::with('member')
            ->whereIn('cp_id', $code)
            ->where('user_id', '!=', '')
            ->whereNotNull('usedate')
            ->where('usedate', '!=', '0000-00-00')
            ->get();
        $data->filter(function ($item) use ($code) {
            return in_array($item->cp_id, $code);
        })->sortBy('cp_id')->pipe(function ($items) {
            Excel::store(new CouponUsedListExport($items), "coupon_used_list.xlsx");
        });
    }

}
