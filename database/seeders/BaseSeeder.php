<?php

namespace Database\Seeders;

use App\Services\Database\TransactionTrait;
use Illuminate\Database\Seeder;

abstract class BaseSeeder extends Seeder
{
    use TransactionTrait;

    protected bool $transaction = true;

    abstract protected function callback();

    protected function errorCallback($t)
    {
        dd($t);
    }

    protected function log()
    {
        dump($this::class);
    }

    protected function transactionCallback(callable $callback)
    {
        $this->runTransaction($callback,
            function ($t) {
                $this->errorCallback($t);
            });
    }

    public function run()
    {
        if($this->transaction) {
            $this->runTransaction(function () {
                $this->callback();
            }, function ($t) {
                $this->errorCallback($t);
            });
        } else {
            $this->callback();
        }
    }

}
