<?php

namespace App\Events;

use App\Jobs\IndexSubmodels;
use App\LightspeedProduct;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class LightspeedProductSaved
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(LightspeedProduct $product)
    {
        foreach($product->submodels as $relation => $resource)
            dispatch(new IndexSubmodels($product, $relation, $resource));
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        dump("event broadcasted");
        //return new PrivateChannel('channel-name');
    }
}
