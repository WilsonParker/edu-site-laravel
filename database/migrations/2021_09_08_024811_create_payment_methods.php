<?php

use Illuminate\Database\Schema\Blueprint;

class CreatePaymentMethods extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'payment_methods';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->string('code', 32)->primary()->nullable(false)->comment('고유키');
        $table->string('name', 32)->nullable(false)->comment('결제방법');
        $table->text('description')->nullable(true)->comment('설명');
    }
}

