<?php

namespace App\Livewire\AdminDashboard\Notifications;

use App\Models\Notification;
use Livewire\Component;

class NotificationsList extends Component
{
    public $notifications;
    public $notificationsCount;
    public $readCount;
    public $unreadCount;
    public $dailyAverage;

    public function mount()
    {
        $this->notifications = Notification::with('donor')
            ->latest()
            ->get(['id', 'donor_id', 'title', 'message', 'type']);
            $this->notificationsCount = Notification::count();
            $this->readCount = Notification::where('is_read', true)->count();
            $this->unreadCount = Notification::where('is_read', false)->count();
            $this->dailyAverage = round(Notification::whereDate('created_at', '>=', now()->subDays(7))->count() / 7, 1);
    }

    public function render()
    {
        return view('livewire.admin-dashboard.notifications.notifications-list')->layout('layouts.app');
    }
}
