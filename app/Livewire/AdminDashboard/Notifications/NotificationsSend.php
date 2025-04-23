<?php

namespace App\Livewire\AdminDashboard\Notifications;

use App\Models\DeviceToken;
use Livewire\Component;

class NotificationsSend extends Component
{
    public $title;
    public $body;

    public function sendNotification(FCMService $fcm)
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string|max:1000',
        ]);

        $tokens = DeviceToken::pluck('token');
        foreach ($tokens as $token) {
            $response = $fcm->sendNotification($token, $this->title, $this->body);

            if (isset($response['error'])) {

                logger()->error("فشل الإرسال إلى $token", $response);
            }
        }

        $this->reset(['title', 'body']);

        $this->dispatch('send-out');
    }
    public function render()
    {
        return view('livewire.admin-dashboard.notifications.notifications-send');
    }
}
