<?php
namespace App\Facades;

use App\Repositories\Cart\CartRepositoryInterface;

class Cart extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        return CartRepositoryInterface::class;
    }
}
