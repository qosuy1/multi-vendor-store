<?php

namespace App\View\Components;

use App\Repositories\Cart\CartRepositories;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CartMenu extends Component
{
    public $items;
    public $totalAmount;
    public $productsCount;
    /**
     * Create a new component instance.
     */
    public function __construct(CartRepositories $cart)
    {
        // Clean up orphaned cart items
        $cart->removeOrphanedItems();

        $this->items = $cart->get()->take(3);
        $this->totalAmount = $cart->getTotalPrice();
        $this->productsCount = $cart->count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.cart-menu');
    }
}
