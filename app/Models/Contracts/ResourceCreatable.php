<?php

namespace App\Models\Contracts;

use App\Models\Common\ResourcesModel;
use Illuminate\Http\UploadedFile;

interface ResourceCreatable
{
    public function getResourcePath(): string;

    public function getResourceStorage(): string;

    public function saveResource(string $origin, ?string $name = null): ResourcesModel;

    public function saveResourceWithFile(UploadedFile $file, ?string $name = null): ResourcesModel;

}
