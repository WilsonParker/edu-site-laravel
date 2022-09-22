<?php

namespace Tests;

use App\Services\Database\TransactionTrait;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use TransactionTrait;

    protected array $logData = [];
    private int $num = 1;

    protected function log(string $str = '', bool $useNum = false)
    {
        $log = now()->format('Y-m-d H:i:s') . ' : ' . $this::class . ' : ' . $this->getCallingMethodName() . ' : ' . $str;
        if ($useNum) {
            dump($log . " / " . $this->num++);
        } else {
            dump($log);
        }
    }

    protected function getCallingMethodName()
    {
        return debug_backtrace()[2]['function'];
    }

    protected function runWithTransaction($callback, $errCallback = null)
    {
        $this->initLogData();
        DB::transaction(function () use ($callback) {
            try {
                $callback();
            } catch (\Throwable $throwable) {
                if (!empty($this->logData)) {
                    $this->logData();
                }
                if (isset($errCallback)) {
                    $errCallback($throwable);
                } else {
                    throw $throwable;
                }
            }
        });
        $this->assertTrue(true);
    }

    protected function initLogData()
    {
        $this->logData = [];
    }

    protected function setLogData(string $key, $data)
    {
        $this->logData[$key] = $data;
    }

    protected function appendLogData(string $key, $data)
    {
        $this->logData[$key][] = $data;
    }

    protected function getLogData(string $key = null)
    {
        return isset($key) ? $this->logData[$key] : $this->logData;
    }

    protected function logData()
    {
        dump($this->logData);
    }

    protected function saveLogData($file)
    {
        $this->getStorage()->put($file, json_encode($this->logData));
    }

    protected function getCashedCollection(string $file, callable $dataCallback, string|callable $bind, callable $resultCallback = null, int $chunk = 0)
    {
        // string
        // object
        $getData = function ($data) use ($bind) {
            if (gettype($bind) == 'string') {
                $model = new $bind();
                return $model::whereIn($model->getKeyName(), $data)->get();
            } else {
                return $bind();
            }
        };

        $saveData = function ($file, $data) use ($bind) {
            if (gettype($bind) == 'string') {
                $model = new $bind();
                $save = $data->pluck($model->getKeyName());
            } else {
                $save = $bind($data);
            }
            $this->getStorage()->put($file, $save);
        };

        if ($this->getStorage()->exists($file)) {
            $data = json_decode($this->getStorage()->get($file));
            if ($chunk > 0) {
                foreach (array_chunk($data, $chunk) as $t) {
                    $resultCallback($getData($t));
                }
            } else {
                $result = $getData($data);
                if (isset($resultCallback)) {
                    $resultCallback($result);
                } else {
                    return $result;
                }
            }
        } else {
            $data = $dataCallback();
            if (isset($resultCallback)) {
                $resultCallback($data);
                $saveData($file, $data);
            } else {
                return $data;
            }
        }
    }

    protected function getStorage(): \Illuminate\Contracts\Filesystem\Filesystem
    {
        return Storage::disk('test');
    }
}
