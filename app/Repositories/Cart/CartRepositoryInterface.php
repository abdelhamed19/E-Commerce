<?php
namespace App\Repositories\Cart;

use App\Models\Product;

interface CartRepositoryInterface
{
    public function getCart();
    public function addToCart(Product $product, $qty = 1);
    public function updateCart($id, $qty);
    public function deleteFromCart($id);
    public function clearCart();
    public function total();
}
