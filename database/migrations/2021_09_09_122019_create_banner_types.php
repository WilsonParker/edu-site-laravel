<?php

use Illuminate\Database\Schema\Blueprint;

class CreateBannerTypes extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'banner_types';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->string('code', 32)->primary()->nullable(false)->comment('고유키');
        $table->string('name', 32)->nullable(false)->comment('이름');
    }

}
