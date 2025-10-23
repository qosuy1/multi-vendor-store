<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class OrderCreatedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $order;
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [/*'mail',*/ 'database', 'broadcast'];
    }

    public function toDatabase(object $notifiable)
    {
        return [
            'title' => "new Order #{$this->order->number} Created",
            'icon' => "fas fa-envelope ",
            'url' => url('/dashboard'),
            'order_id' => $this->order->number
        ];
    }

    public function toBroadcast(object $notifiable)
    {
        $order_number = $this->order->number ;
        return new BroadcastMessage([
            'title' => "new Order Created #{$order_number}",
            'body' => "You have a new order #{$order_number} .",
            'products_count' => $this->order->orderItems()->count(),
            'type' => 'success', // or 'error', 'warning', 'info'
        ]);
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $address = $this->order->billingAddress;
        return (new MailMessage)
            ->subject("new Order #{$this->order->number}")
            ->greeting("Hello {$notifiable->name}")
            ->line("A New order (#{$this->order->number}) created by {$address->name} From {$address->country_name}")
            ->action('Order', url('/dashboard'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
