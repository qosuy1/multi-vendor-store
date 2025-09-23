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
    public function get(): Collection
    {
        return Cart::with('product')->where('cookie_id', $this->getCookieId())->get();
    }

    public function add(Product $product, $quantity = 1): Cart
    {
        $item = Cart::where('product_id', $product->id)->where('cookie_id', $this->getCookieId())->first();
        if ($item) {
            $item->quantity += $quantity;
            $item->save();
            return $item;
        }
        return Cart::create([
            'cookie_id' => $this->getCookieId(),
            'user_id' => Auth::user()->id,
            'product_id' => $product->id,
            'quantity' => $quantity,
        ]);
    }
    public function update(Product $product, int $quantity): Cart
    {
        $cart = Cart::where('product_id', $product->id)->where('cookie_id', $this->getCookieId())->first();
        $cart->quantity = $quantity;
        $cart->save();
        return $cart;
    }
    public function delete($id): void
    {
        Cart::where('cookie_id', $this->getCookieId())->where('id', $id)->delete();
    }
    public function clear(): void
    {
        Cart::where('cookie_id', $this->getCookieId())->delete();
    }
    public function count(): int
    {
        return (int) Cart::where('cookie_id', $this->getCookieId())->count();
    }
    // public function total(): float
    // {
    //     return Cart::sum('quantity');
    // }
    public function getTotalQuantity(): int
    {
        return Cart::where('cookie_id', $this->getCookieId())->sum('quantity');
    }
    public function getTotalPrice(): float
    {
        // return Cart::where('cookie_id', $this->getCookieId())->sum('quantity' * $product->price);
        return (float) Cart::where('cookie_id', $this->getCookieId())
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->selectRaw('sum(carts.quantity * products.price) as total')
            ->value('total');
    }

    protected function getCookieId()
    {
        $cookieId = Cookie::get('cart_id');
        if (!$cookieId) {
            $cookieId = Str::uuid();
            Cookie::queue('cart_id', $cookieId, Carbon::now()->addDays(30)->getTimestamp() - now()->getTimestamp());
            // the cookie will be deleted after 30 days , or 30 * 24 * 60
        }
        return $cookieId;
    }
}
