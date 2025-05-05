<?php

namespace App\Events;

use App\Models\OrganizationProjectRequest;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProjectCreatedEvent implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public $case;

    public function __construct(OrganizationProjectRequest $case)
    {
        $this->case = $case;
    }

    public function broadcastOn()
    {
        return new Channel('project-updates');
    }

    public function broadcastAs()
    {
        return 'ProjectCreated';
    }
}
