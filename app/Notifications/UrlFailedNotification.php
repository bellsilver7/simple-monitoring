<?php

namespace App\Notifications;

use App\Broadcasting\ZulipChannel;
use App\Models\Url;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL as FacadesUrl;

class UrlFailedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(
        private Url $url
    )
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [
//            'mail',
            ZulipChannel::class,
        ];
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
            ->subject('SOS: URL failed')
            ->line('A URL failed during monitoring.')
            ->action('URL: ', $this->url->url)
            ->line('Thank you for using our application!');
    }

    public function toZulip($notifiable)
    {
        $url = FacadesUrl::temporarySignedRoute(
            'url.re-activate',
            now()->addMinutes(30),
            ['url' => $this->url->id]
        );

        $message = "SOS: The URL {$this->url->url} is not working. Please check soon. Click here to re-activate the monitoring {$url}";

        logger($message);

        return [
            'url' => $this->url->url,
            'message' => $message,
        ];
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
