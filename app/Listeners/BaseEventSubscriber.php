<?php

namespace App\Listeners;


use LaravelSupports\Libraries\Exceptions\Logs\ExceptionLogger;
use LaravelSupports\Listeners\Abstracts\AbstractEventSubscriber;

abstract class BaseEventSubscriber extends AbstractEventSubscriber
{

    public function failed($event, \Exception $exception)
    {
        $logger = new ExceptionLogger();
        $logger->report($exception);
        $e = new \Exception($event->getErrorMessage());
        $logger->report($e);
        $this->handleException($event, $exception, $logger);
    }
}
