<?php

use Illuminate\Database\Schema\Blueprint;

class CreateBanners extends \LaravelSupports\Libraries\Supports\Databases\Migrations\CreateMigration
{
    protected string $table = 'banners';

    protected function defaultUpTemplate(Blueprint $table)
    {
        $table->unsignedInteger('idx')->autoIncrement()->comment('고유키');
        $table->string('banner_type_code', 32)->nullable(false)->comment('Banner_Types 고유키 참조');
        $table->string('name', 32)->nullable(false)->comment('이름');
        $table->string('url', 256)->nullable(false)->comment('url');
        $table->timestamp('start')->nullable(false)->useCurrent()->comment('노출 시작일');
        $table->timestamp('end')->nullable(true)->comment('노출 종료일');
        $table->boolean('is_public')->nullable(false)->default(true)->comment('공개 여부');

        $table->foreign('banner_type_code')->on('banner_types')->references('code')->cascadeOnUpdate()->cascadeOnDelete();
    }

}
