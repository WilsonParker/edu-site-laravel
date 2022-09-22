<?php

namespace App\Listeners;


use App\Notifications\ReportSlackNotification;
use Illuminate\Support\Facades\Notification;
use LaravelSupports\Libraries\Exceptions\Logs\ExceptionLogger;
use LaravelSupports\Listeners\Abstracts\AbstractEventSubscriber;

class SlackNotificationEventSubscriber extends AbstractEventSubscriber
{
    /**
     * @var string[]
     */
    protected array $events = [
        SlackReportProblemEvent::class,
    ];

    public function handleEvent($event)
    {
        Notification::route('slack', $event->getWebhookURL())
            ->notify(new ReportSlackNotification($event->getContent(), $event->getFromName(), $event->getAttachments(), $event->getLevel(), $event->getEmoji()));
    }

    public function failed(AbstractSlackNotificationEvent $event, \Exception $exception)
    {
        $logger = new ExceptionLogger();
        $logger->report($exception);
        $e = new \Exception($event->getErrorMessage());
        $logger->report($e);
        $this->handleException($event, $exception, $logger);
    }
}
