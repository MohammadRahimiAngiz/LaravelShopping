<?php

namespace App\Notifications;

use App\Notifications\channels\GhasedakChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class activeCode extends Notification
{
    use Queueable;

    public $code;
    public $phoneNumber;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($code, $phoneNumber)
    {
        $this->code = $code;
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via()
    {
        return [ghasedakChannel::class];
    }

    public function toGhasedakSms()
    {
        return [
            'text' => "The verification and activation code is :"."{$this->code}",
            'phone' => $this->phoneNumber,
        ];
    }
}
