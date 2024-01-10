<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Enquete;
use Illuminate\Support\Facades\Redis;
class EnqueteStatusUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $enquete;

    public function __construct(Enquete $enquete)
    {
        $this->enquete = $enquete;
    }

    public function broadcastOn()
    {
        return new Channel('enquete-channel');
    }
}
