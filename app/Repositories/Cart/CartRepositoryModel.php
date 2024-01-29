<?php

namespace App\Repositories\Cart;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CartRepositoryModel implements CartRepositoryInterface
{
    public function getCart()
    {
        return Cart::where("cookie_id", "=", $this->getCookie())->get();
    }
    public function addToCart(Product $product, $qty = 1)
    {
        Cart::create([
            "cookie_id" => $this->getCookie(),
            "user_id" => Auth::id(),
            "product_id" => $product->id,
            "quantity" => $qty,
        ]);
    }
    public function updateCart(Product $product, $qty)
    {
        Cart::where("cookie_id", "=", $this->getCookie())->update([
            "quantity" => $qty,
        ]);
    }
    public function deleteFromCart(Product $product)
    {
        Cart::where("cookie_id", "=", $this->getCookie())
            ->where("product_id",$product->id)->delete();
    }
    public function clearCart()
    {
        Cart::where("cookie_id", "=", $this->getCookie())->destroy();
    }
    public function total()
    {
        return Cart::where("cookie_id", "=", $this->getCookie())
            ->join("products","products.id","=","carts.product_id")
            ->selectRaw("SUM(products.price * carts.quantity) as total")
            ->value("total");
    }
    public function getCookie()
    {
        $cookie_id=Cookie::get("cart");
        if(!$cookie_id){
            $cookie_id=Str::uuid();
            Cookie::queue("cart",$cookie_id,60*24*30);
        }
        return $cookie_id;
    }
}
