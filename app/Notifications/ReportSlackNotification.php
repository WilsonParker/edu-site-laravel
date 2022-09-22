<?php

namespace App\Notifications;


use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class ReportSlackNotification extends Notification
{
    use Queueable;

    protected $attachments;
    protected $content;
    protected $fromName;
    protected $emoji;
    protected $to;
    protected $level;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($content, $fromName = '', $attachments = [], $level = '', $emoji = ':speech_balloon:', $to = null)
    {
        $this->attachments = $attachments;
        $this->content = $content;
        $this->fromName = $fromName;
        $this->emoji = $emoji;
        $this->to = $to;
        $this->level = $level;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    /**
     * Get the slack representation of the notification.
     *
     * @param mixed $notifiable
     * @return SlackMessage
     */
    public function toSlack($notifiable)
    {
        $slack = new SlackMessage();
        $slack->from($this->fromName, $this->emoji);
        $slack->content($this->content);
        if (!is_null($this->to)) {
            $slack->to($this->to);
        }

        if (!empty($this->attachments)) {
            $attachments = $this->attachments;
            $slack->attachment(function ($attachment) use ($attachments) {
                $attachment->title($attachments['title'], $attachments['url'])
                    ->content($attachments['content']);
            });
        }

        switch ($this->level) {
            case 'error' :
                $slack->error();
                break;
            case 'success' :
                $slack->success();
                break;
            case 'warning' :
                $slack->warning();
                break;
            case 'info' :
                $slack->info();
                break;
            default:
        }

        return $slack;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
