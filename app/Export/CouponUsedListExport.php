<?php

namespace App\Export;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CouponUsedListExport implements FromView, WithHeadings
{
    private $data;

    /**
     * HrdListExport constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function headings(): array
    {
        return [
        ];
    }

    public function view(): View
    {
        return view('exports.coupon_used_list', [
            'data' => $this->data
        ]);
    }

}
