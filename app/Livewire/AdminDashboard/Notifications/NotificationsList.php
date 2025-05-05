<?php

namespace App\Livewire\AdminDashboard\Notifications;

use App\Models\Notification;
use Livewire\Attributes\On;
use Livewire\Component;

class NotificationsList extends Component
{
    public $notifications;
    public $notificationsCount;
    public $readCount;
    public $unreadCount;
    public $dailyAverage;       


    #[On('send-out')]
    public function refreshNotifications()
    {
        $this->notifications = Notification::with('donor')
            ->latest()
            ->get();
            $this->notificationsCount = Notification::count();
            $this->readCount = Notification::where('is_read', true)->count();
            $this->unreadCount = Notification::where('is_read', false)->count();
            $this->dailyAverage = round(Notification::whereDate('created_at', '>=', now()->subDays(7))->count() / 7, 1);
    }
    public function mount()
    {
        $this->refreshNotifications();
    }

    public function render()
    {
        return view('livewire.admin-dashboard.notifications.notifications-list')->layout('layouts.app');
    }
}
