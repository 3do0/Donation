<?php

namespace App\Events;

use App\Models\OrganizationCaseRequest;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CaseCreatedEvent implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public $case;

    public function __construct(OrganizationCaseRequest $case)
    {
        $this->case = $case;
    }

    public function broadcastOn()
    {
        return new Channel('case-updates');
    }

    public function broadcastAs()
    {
        return 'CaseCreated';
    }
}
