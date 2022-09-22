<?php

namespace App\Http\Controllers\Web;

use App\Models\Common\ResourcesModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class BaseController extends \App\Http\Controllers\BaseController
{
    protected string $root = 'web';

    public function download(Request $request, Response $response, ResourcesModel $resource)
    {
        return Storage::disk('data')->download($resource->getPath(), $resource->origin_name);
    }
}
