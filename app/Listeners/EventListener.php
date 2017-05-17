<?php

namespace App\Listeners;

use App\Events\LightspeedProductSaved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  LightspeedProductSaved  $event
     * @return void
     */
    public function handle(LightspeedProductSaved $event)
    {
        //
    }
}
