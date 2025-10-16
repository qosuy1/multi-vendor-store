<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Repositories\Cart\CartModelRepositories;
use Illuminate\Support\Facades\DB;

class DeductProductQuantity
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
        $order = $event->order;
        // dd($order);
        // UPDATE products SET quantity = quantity - $cartItem->quantity

        // -------------[way 1]-----------
        foreach ($order->products as $product) {
            // $product->decrement($product->pivot->quantity);
            $product->quantity = $product->quantity - $product->pivot->quantity;
            $product->save();
        }

        // -------------[way 2]-----------
        // $cart = new CartModelRepositories();
        // foreach ($cart->get() as $cartItem) {
        //     Product::where('id', $cartItem->product_id)
        //         ->update(
        //             [
        //                 'quantity' => DB::raw("quantity - {$cartItem->quantity}")
        //             ]
        //         );
        // }
    }
}
