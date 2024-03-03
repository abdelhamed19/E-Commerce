<?php

namespace App\Http\Controllers\Front;

use App\Models\OrderItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Symfony\Component\Intl\Countries;
use App\Repositories\Cart\CartRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderAddress;
use Throwable;

class CheckoutController extends Controller
{
    public function create(CartRepositoryInterface $cart)
    {
        $countries=Countries::getNames();;
        if($cart->getCart()->isEmpty()){
            return redirect()->route("home");
        }
        return view('front.checkout',compact('cart','countries'));
    }
    public function store(Request $request, CartRepositoryInterface $cart)
    {
        $items=$cart->getCart()->groupBy('product.store_id')->all();
        DB::beginTransaction();
        try{
            foreach($items as $store_id => $cart_items)
            {
                $order=Order::create([
                    'user_id'=>Auth::id(),
                    'store_id'=>$store_id,
                    'payment_method'=>'cod'
                ]);

                foreach($cart_items as $item){
                    OrderItems::create([
                        'order_id'=>$order->id,
                        'product_id'=>$item->product_id,
                        'product_name'=>$item->product->name,
                        'price'=>$item->product->price,
                        'quantity'=>$item->quantity,
                    ]);
                }
            }
            foreach ($request->addr as $type => $address)
            {
                $address['type']=$type;
                $address['order_id']=$order->id;
                OrderAddress::create($address);
                //$order->addresses()->create($address);
            }
            $cart->clearCart();
            DB::commit();
        }

        catch(Throwable $e){
            DB::rollBack();
            throw $e;
        }
        return redirect()->route('home')->with('success','Order has been placed successfully');
    }
}
