<?php

namespace App\Http\Controllers\Front;

use App\Events\OrderCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderItem;
use App\Repositories\Cart\CartRepositories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Intl\Countries;

class CheckoutController extends Controller
{
    //
    public function create(CartRepositories $cart)
    {

        if ($cart->get()->count() <= 0)
            return redirect()->route('front.home');

        return view(
            'front.checkout',
            [
                'cart' => $cart,
                'countries' => Countries::getNames()
            ]
        );
    }

    public function store(CheckoutRequest $request, CartRepositories $cart)
    {
        $request->validated();

        // this line return cart_items and group them by store_id
        // the key of the array is store_id
        $items = $cart->get()->groupBy('product.store_id')->all();

        // start database transactions
        DB::beginTransaction();

        try {
            foreach ($items as $store_id => $cart_items) {
                $order = Order::create(
                    [
                        'user_id' => auth()->id(),
                        'store_id' => $store_id,
                        'payment_method' => 'cod'
                    ]
                );

                foreach ($cart_items as $item) {
                    OrderItem::create([
                        'store_id' => $store_id,
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'product_name' => $item->product->name,
                        'price' => $item->product->price,
                        'quantity' => $item->quantity
                    ]);
                }

                foreach ($request->post('adder') as $type => $address) {
                    $address['type'] = $type;
                    $order->addresses()->create($address);
                }
            }
            // to commit all the changes to database
            Db::commit();

            // this event clear the cart and deduct product Quantity
            // connect the event with listener in (EventServiceProvider)
            event(new OrderCreated($order , $cart));
            // [[[[[  Another Way  ]]]]]
            // OrderCreated::dispatch($order , $cart);


        } catch (\Throwable $th) {

            // to rollback all the changes
            Db::rollBack();
            throw $th;
        }


        return redirect()->route('front.home');

    }
}
