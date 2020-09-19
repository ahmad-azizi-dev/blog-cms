<?php

namespace App\Events;

use App\Position;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VisitLogEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $visit;

    /**
     * Create a new event instance.
     *
     * @param Position $visit
     */
    public function __construct(Position $visit)
    {
        $this->visit = $visit;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
