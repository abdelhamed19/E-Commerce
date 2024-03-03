<?php

namespace App\View\Components;

use Closure;
use App\Facades\Cart;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use App\Repositories\Cart\CartRepositoryInterface;

class CartMenu extends Component
{
    public $total;
    public $items;
    /**
     * Create a new component instance.
     */
    public function __construct(CartRepositoryInterface $cart)
    {
        $this->items = $cart->getCart();
        $this->total = $cart->total();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cart-menu');
    }
}
