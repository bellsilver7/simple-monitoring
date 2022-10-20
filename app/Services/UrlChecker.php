<?php

namespace App\Services;

use App\Models\Url;
use App\Models\UrlFailure;
use App\Models\User;
use App\Notifications\UrlFailedNotification;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;

class UrlChecker
{
    public function getStatus(Url $url)
    {
      $startTime = microtime(true);
      $response = Http::get($url->url);
      $totalTime = microtime(true) - $startTime;
      logger($totalTime);

      if ($response->failed() && !$url->failing) {
        $this->notifyOnError($url);

        UrlFailure::create(['url_id' => $url->id]);

        $url->failing = true;
        $url->save();

        return false;
      }

      $url->successes()->create([
        'time' => round($totalTime, 2),
      ]);

      return $response->ok();
    }

    private function notifyOnError(Url $url)
    {
        $user = User::find(1);
        Notification::send($user, new UrlFailedNotification($url));
    }
}
