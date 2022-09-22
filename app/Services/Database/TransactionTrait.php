<?php


namespace App\Services\Database;


use Illuminate\Support\Facades\DB;

trait TransactionTrait
{
    public function runTransaction($callback, $errCallback)
    {
        DB::beginTransaction();
        try {
            $callback();
            DB::commit();
        } catch (\Throwable $t) {
            DB::rollBack();
            $errCallback($t);
        }
    }
}
