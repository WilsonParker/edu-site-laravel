<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use LaravelSupports\Events\Abstracts\AbstractEvent;

abstract class BaseEvent extends AbstractEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

}
