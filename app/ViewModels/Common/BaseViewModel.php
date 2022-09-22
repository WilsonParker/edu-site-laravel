<?php

namespace App\ViewModels\Common;

use App\Traits\BuildImageUrlTrait;
use Illuminate\Http\Request;

class BaseViewModel extends \LaravelSupports\ViewModels\BaseViewModel
{
    use BuildImageUrlTrait;

    public int $page = 1;
    public string $menuTitle = '';
    public string $ip = '';

    public function __construct($data = null, $searchData = [])
    {
        $this->data = $data;
        $this->searchData = $searchData;
        $this->load();
    }

    public function setIp(Request $request)
    {
        $this->ip = $request->ip();
    }
}
