<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\OrderCreated;
use App\Notifications\OrderCreatedNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class SendOrderCreatedNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event): void
    {
        $orders = $event->orders;
        foreach ($orders as $order) {
            $user = User::where('store_id', $order->store_id)->first();
            // Notification::send($users, new OrderCreatedNotification($order));
            $user->notify(new OrderCreatedNotification($order));
            // sleep( 10);

        }
    }
}
