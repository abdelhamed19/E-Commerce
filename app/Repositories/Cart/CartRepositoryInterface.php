<?php
namespace App\Repositories\Cart;

use App\Models\Product;

interface CartRepositoryInterface
{
    public function getCart();
    public function addToCart(Product $product, $qty = 1);
    public function updateCart(Product $product, $qty);
    public function deleteFromCart(Product $product);
    public function clearCart();
    public function total();
}
