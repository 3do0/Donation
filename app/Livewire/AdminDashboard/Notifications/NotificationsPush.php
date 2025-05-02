<?php

namespace App\Livewire\AdminDashboard\Notifications;

use App\Models\Donor;
use Livewire\Component;

class NotificationsPush extends Component
{

    public $title;
    public $body;

    public function sendNotification()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string|max:1000',
        ]);

        $donors = Donor::all();
        foreach ($donors as $donor) {
            $donor->notifications()->create([
                'title' => $this->title,
                'message' => $this->body,
            ]);
        }

        $this->reset(['title', 'body']);

        $this->dispatch('send-out');
    }

    public function render()
    {
        return view('livewire.admin-dashboard.notifications.notifications-push');
    }
}
