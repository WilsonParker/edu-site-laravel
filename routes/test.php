<?php

use App\Services\Hrd\HrdBusinessService;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;

Route::get('/attachment', function () {
    $model = \App\Models\Common\ResourcesModel::find('1398');
    $file = \Illuminate\Support\Facades\Storage::disk('public')->url($model->path . $model->name);
});

Route::get('/board', function () {
    $model = \App\Models\Boards\BoardsModel::find('1398');
    $file = \Illuminate\Support\Facades\Storage::disk('public')->url($model->path . $model->name);
});

Route::prefix('hrd')->group(function () {
    Route::get('list', function () {
        ini_set('memory_limit', '-1');

        $start = '20170101';
        $end = '20170101';

        $result = [];
        $service = new HrdBusinessService();
        $service
            ->setPageSize(100)
            ->setTrainingStartDate($start)
            ->setTrainingEndDate($end);
        do {
            $service->callListAPI();
            $response = $service->getResult();
            $result = array_merge($result, $response->items);
            $service->addPageNum();
        } while ($response->getCount() > $service->getPageNum() * $service->getPageSize());

        dump($result);
        // https://www.hrd.go.kr/jsp/HRDP/HRDPO00/HRDPOA62/HRDPOA62_2.jsp?authKey=xoDHzdUMoTKFrtHZUTJciZVp4rzAleto&returnType=XML&outType=2&srchTrprId=ABA20162000603838&srchTrprDegr=12&srchTorgId=500020015894
        // return Excel::download(new HrdListExport($result), "hrd_{$start}_{$end}.xlsx");
    });
});

Route::prefix('emon')->group(function () {
    Route::get('vote', function () {
        $vote = \App\OriginModels\Lectures\VoteModel::with('classVote')
            ->find(1);

        \App\OriginModels\Emon\TBSurveyModel::create([
            'SURVEY_CATE_ID' => $vote->vote_gubun,
            'SURVEY_ID' => $vote->vote_id,
            'SURVEY_CATE_NAME' => $vote->vote_gtitle,
            'SURVEY_TITLE' => $vote->vote_title,
        ]);

        dump($vote);
    });
});
