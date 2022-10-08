<?php

namespace App\Broadcasting;

use App\Models\User;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;

class ZulipChannel
{
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     *
     * @param \App\Models\User $user
     * @return array|bool
     */
    public function join(User $user)
    {
        //
    }

    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toZulip($notifiable);

        logger($message);
        Http::withOptions([
            'base_url' => config('services.zulip.url') . '/api/v1/messages',
        ])
            ->withBasicAuth(
                config('services.zulip.user'),
                config('services.zulip.key')
            )
            ->asForm()
        ->post('/messages', [
            'type' => 'stream',
            'to' => 'Perfectionist',
            'topic' => 'stream events',
            'content' => $message['message'],
        ]);
    }
}
