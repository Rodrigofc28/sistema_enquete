<?php

namespace App\Listeners;

use App\Events\EnqueteStatusUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Redis;
class EnqueteStatusUpdatedListener
{
    public function handle(EnqueteStatusUpdated $event)
    {
        // Transmitir o evento usando WebSockets
        Broadcast::to('enquete-channel')->with($event->enquete)->event('enquete-status-updated');
    }
}

