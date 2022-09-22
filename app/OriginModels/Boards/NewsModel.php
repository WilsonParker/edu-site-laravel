<?php

namespace App\OriginModels\Boards;

use App\OriginModels\Common\BaseModel;

//공지사항
class NewsModel extends BaseModel
{
    protected $table = 'lms_news';

    protected $casts = [
        'regdate' => 'date'
    ];
}
