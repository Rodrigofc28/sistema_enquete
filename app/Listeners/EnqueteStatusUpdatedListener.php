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
        // Verificar se o evento foi originado externamente
        if ($event->source === 'external') {
            // Transmitir o evento usando WebSockets
            Broadcast::event(new EnqueteStatusUpdated('internal'));
        }
        
        // Aqui você pode personalizar a transmissão conforme necessário
        // Evitar emitir o evento novamente se originado internamente
    }
}


