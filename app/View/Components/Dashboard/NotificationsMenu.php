<?php

namespace App\View\Components\Dashboard;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class NotificationsMenu extends Component
{

    public $notifications ;
    public $newNotificationsCount ;
    public $allNotificationsCount ;
    /**
     * Create a new component instance.
     */
    public function __construct($count = 10)
    {
        $user = Auth::user() ;
        $this->notifications = $user->notifications()->take($count)->latest()->get() ;
        $this->newNotificationsCount = $user->unreadNotifications()->count() ;
        $this->allNotificationsCount = $user->notifications()->count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.notifications-menu');
    }
}
