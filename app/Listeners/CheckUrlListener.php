<?php

namespace App\Listeners;

use App\Events\CheckUrl;
use App\Services\UrlChecker;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CheckUrlListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(private UrlChecker $urlChecker)
    {
    }

    /**
     * Handle the event.
     *
     * @param CheckUrl $event
     * @return void\
     */
    public function handle(CheckUrl $event)
    {
        logger('Listen: ' . $event->url->url);
        $this->urlChecker->getStatus($event->url);
    }
}
