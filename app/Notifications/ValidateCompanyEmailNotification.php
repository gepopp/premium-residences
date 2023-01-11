<?php

namespace App\Notifications;


use Illuminate\Bus\Queueable;
use Illuminate\Support\HtmlString;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;




class ValidateCompanyEmailNotification extends Notification
{
    use Queueable;




    public $code;




    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($code)
    {

        $this->code = $code;
    }




    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {

        return [ 'mail' ];
    }




    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

        return (new MailMessage)
            ->subject(__('Validate Company E-Mail'))
            ->line(__('To finalize your company registration, please enter the below code:'))
            ->line( new HtmlString('<p style="font-size:18px; font-weight:bold;">' . $this->code . '</p>'));
    }




    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {

        return [
            //
        ];
    }
}
