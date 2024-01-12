<?php



namespace App\Listeners;

use App\Events\EnqueteStatusUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Broadcast;

class EnqueteStatusUpdatedListener
{
    public function handle(EnqueteStatusUpdated $event)
    {
        
    }
}


