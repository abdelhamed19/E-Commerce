<?php

namespace App\Repositories\Cart;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartRepositoryModel implements CartRepositoryInterface
{
    protected $item;
    public function __construct()
    {
        $this->item = collect();
    }
    public function getCart()
    {
        if(!$this->item->count())
        {
            $this->item = Cart::with("product")->get();
        }
        return $this->item;
    }
    public function addToCart(Product $product, $qty = 1)
    {
        $item=Cart::where("product_id",$product->id)->first();
        if(!$item)
        {
            return $cart = Cart::create([
                "user_id" => Auth::id(),
                "product_id" => $product->id,
                "quantity" => $qty,
            ]);
            $this->item->push($cart);
        }
        return $item->increment("quantity",$qty);
    }
    public function updateCart($id, $qty)
    {
        Cart::where("id",$id)->update([
            "quantity" => $qty,
        ]);
    }
    public function deleteFromCart($id)
    {
        Cart::where("product_id",$id)->delete();
    }
    public function clearCart()
    {
        Cart::query()->delete();
    }
    public function total()
    {
        return $this->getCart()->sum(function($item){
            return $item->product->price * $item->quantity;
        });
    }
}
