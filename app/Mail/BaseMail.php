<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

abstract class BaseMail extends Mailable implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $dataKey = 'data';
    protected $data;
    protected string $receiverGroup;

    public array $receivers = [
        'dev9163@linkareer.com',
    ];

    public array $receiverGroups = [
        'test' => [
            'dev9163@linkareer.com',
        ],
    ];

    /**
     * Create a new message instance.
     *
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
        $this->init();
    }

    protected function init()
    {

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): BaseMail
    {
        try {
            return $this->buildMail();
        } catch (\Throwable $e) {
            $this->failed($e);
        }
    }

    protected function buildMail(): BaseMail
    {
        $this->buildReceivers();

        return $this
            ->subject($this->getSubjectString())
            ->with($this->dataKey, $this->data)
            ->view($this->getViewString());
    }

    protected function buildReceivers()
    {
        $receivers = isset($this->receiverGroups[$this->receiverGroup]) ? $this->receiverGroups[$this->receiverGroup] : $this->receivers;
        foreach ($receivers as $receiver) {
            $this->to($receiver);
        }
    }

    public function failed(\Throwable $exception)
    {
    }

    /**
     * Get view name
     *
     * @return string
     */
    abstract protected function getViewString(): string;

    /**
     * Get subject
     *
     * @return string
     */
    abstract protected function getSubjectString(): string;

}
