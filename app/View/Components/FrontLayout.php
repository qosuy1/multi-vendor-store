<?php

namespace App\View\Components;

use App\Repositories\Cart\CartModelRepositories;
use App\Repositories\Cart\CartRepositories;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FrontLayout extends Component
{
    public $title ;
    public $cartCount;
    /**
     * Create a new component instance.
     */
    public function __construct($title = null)
    {
        $this->title =  config('app.name') . " | " . $title;
        $this->cartCount = (new CartModelRepositories())->count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('layouts.front');
    }
}
