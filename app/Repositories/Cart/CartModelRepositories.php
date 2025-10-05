<?php

namespace App\Repositories\Cart;

use App\Models\Cart;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Database\Eloquent\Collection;

class CartModelRepositories implements CartRepositories
{

    protected $items;

    public function __construct()
    {
        $this->items = collect([]);
    }

    public function get(): Collection
    {
        if (!$this->items->count())
            $this->items = Cart::with('product')->latest()->get();
        return $this->items;
    }

    public function add(Product $product, $quantity = 1): Cart
    {
        $item = Cart::where('product_id', $product->id)->first();
        if ($item) {
            $item->quantity += $quantity;
            $item->save();
        } else {
            $item = Cart::create([
                'user_id' => Auth::user()->id ?? null,
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);
            $this->get()->push($item);
        }
        return $item;
    }
    public function update($id, int $quantity): Cart
    {
        $cart = Cart::where('id', $id)->first();
        $cart->quantity = $quantity;
        $cart->save();
        return $cart;
    }
    public function delete($id): void
    {
        Cart::where('id', $id)->delete();
    }
    public function clear(): void
    {
        Cart::query()->delete();
    }

    public function removeOrphanedItems(): void
    {
        // Remove cart items where the product no longer exists
        Cart::whereDoesntHave('product')->delete();
    }
    public function count(): int
    {
        return (int) Cart::query()->count();
    }
    // public function total(): float
    // {
    //     return Cart::sum('quantity');
    // }
    public function getTotalQuantity(): int
    {
        return Cart::query()->sum('quantity');
    }
    public function getTotalPrice(): float
    {
        // return Cart::where('cookie_id', $this->getCookieId())->sum('quantity' * $product->price);
        // return (float) Cart::join('products', 'carts.product_id', '=', 'products.id')
        //     ->selectRaw('sum(carts.quantity * products.price) as total')
        //     ->value('total');

        return $this->get()->sum(function ($item) {
            // Check if product exists and has a price
            if ($item->product && $item->product->price) {
                return $item->quantity * $item->product->price;
            }
            // If product is null or has no price, return 0
            return 0;
        });
    }


}
