<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait BuildImageUrlTrait
{
    public function buildImageUrl(string $url): string
    {
        $imageUrl = Str::of(config('constants.image.url'));
        if($imageUrl->endsWith(['/'])) {
            $imageUrl = $imageUrl->beforeLast('/');
        }
        return $imageUrl . Str::of($url)->start('/');
    }

}
