<?php

namespace App\Listeners;


use App\Events\LecturePlayEvent;

class LectureEventSubscriber extends BaseEventSubscriber
{
    /**
     * @var string[]
     */
    protected array $events = [
        LecturePlayEvent::class,
    ];

    public function handleEvent($event)
    {
        $event->handle();
    }


}
