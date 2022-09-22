<?php

namespace App\Events;

use App\Models\Lectures\MemberLectureProgressRateHistoriesModel;

/**
 * 강의 재생 시 실행됩니다
 * 수강 시간을 업데이트 하기 위한 event
 *
 * @author  dev9163
 * @added   2021/11/23
 * @updated 2021/11/23
 */
class LecturePlayEvent extends BaseEvent
{

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(public MemberLectureProgressRateHistoriesModel $model, public string $time)
    {
        //
    }


    public function handle()
    {
        $this->model->end = $this->time;
        $this->model->save();
    }

}
