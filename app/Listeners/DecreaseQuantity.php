<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Facades\Cart;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DecreaseQuantity
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
    public function handle($event): void
    {
       foreach ($event->products as $items)
       {
           $items->decrement("quantity",$items->pivot->quantity);
       }

        // foreach (Cart::getCart() as $items)
        // {
        //     $products=Product::where("id",$items->product_id)->get();
        //     foreach ($products as $product)
        //     {
        //         $product->update([
        //                 "quantity"=>$product->quantity - $items->quantity]);
        //     }
        // }

    }
}
