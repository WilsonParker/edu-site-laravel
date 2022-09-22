<?php

namespace Tests\Unit\Aws;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class S3Test extends TestCase
{

    public function testS3Upload()
    {
        ini_set('memory_limit', '-1');

        $start = 0;
        $end = 150;
        $try = 3;
        $num = 0;

        $this->execute($start, $end, $try, $num);

        self::assertTrue(true);
    }

    public function testS3Upload2()
    {
        ini_set('memory_limit', '-1');

        $start = 120;
        $end = 120;
        $try = 3;
        $num = 0;

        $this->execute($start, $end, $try, $num);

        self::assertTrue(true);
    }

    public function testS3Upload3()
    {
        ini_set('memory_limit', '-1');

        $start = 140;
        $end = 140;
        $try = 3;
        $num = 0;

        $this->execute($start, $end, $try, $num);

        self::assertTrue(true);
    }

    public function testS3Upload4()
    {
        ini_set('memory_limit', '-1');

        $start = 150;
        $end = 150;
        $try = 3;
        $num = 0;

        $this->execute($start, $end, $try, $num);

        self::assertTrue(true);
    }

    public function execute(int $start, int $end, int $try = 0, int $num = 0)
    {
        $tried = 1;
        while ($start < $end) {
            try {
                $this->upload($start, $num);
                $num = 0;
                $start++;
            } catch (\Throwable $throwable) {
                $message = "error in $start : $num / try : $tried/$try";
                Log::error($message);
                dump($message);
                if ($tried >= $try) {
                    dump($throwable->getMessage());
                    self::fail();
                } else {
                    $tried++;
                }
            }
        }
    }

    public function upload(string $directory, &$num = 0)
    {
        Log::debug("start directory : $directory");
        $vod = Storage::disk('vod');
        if ($vod->missing($directory)) {
            dump('missing directory');
        }

        $files = $vod->allFiles($directory);

        $total = sizeof($files);
        for ($i = $num; $i < $total; $i++) {
            $file = $files[$i];
            if (Storage::disk('s3')->missing($file) || !$this->isSameSize($file)) {
                dump("[$total/" . ($num + 1) . ")] " . (now()->format('Y-m-d H:i:s')) . " $file");
                Storage::disk('s3')->put($file, $vod->get($file));
            }
            $num++;
        }

        Log::debug("end directory : $directory");
    }

    private function isSameSize(string $file): bool
    {
        return Storage::disk('s3')->size($file) == Storage::disk('vod')->size($file);
    }

}
