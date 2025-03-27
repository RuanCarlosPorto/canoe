<?php

namespace App\Listeners;

use App\Events\DuplicateFundWarning as EventsDuplicateFundWarning;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class DuplicateFundWarning
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(EventsDuplicateFundWarning $event): void
    {
        Log::warning('Duplicate Fund Warning: ' . $event->fund->name . ' - ' . $event->fund->id);
        Log::warning('Duplicate Fund Warning - Duplicates: ' . $event->duplicates->pluck('name')->implode(', '));
    }
}
