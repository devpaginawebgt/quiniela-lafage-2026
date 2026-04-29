<?php

namespace App\Listeners;

use App\Events\MatchCreated;
use App\Http\Services\PartidoService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddMatchBrands
{
    /**
     * Create the event listener.
     */
    public function __construct(
        private readonly PartidoService $partidoService
    ) {}

    /**
     * Handle the event.
     */
    public function handle(MatchCreated $event): void
    {
        $partido = $event->partido;

        $this->partidoService->addPartidoBrands($partido);
    }
}
