<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'store_id',
        'payment_method',
        'number',
    ];
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Guest',
        ]);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class,"order_items","order_id","product_id","id","id")
        ->withPivot([
            "quantity",
            "price",
            "product_name",
        ]);
    }
    public function addresses()
    {
        return $this->hasMany(OrderAddress::class);
    }
    public function billingAddress()
    {
        return $this->hasOne(OrderAddress::class)->where("type","billing");
    }
    public function shippingAddress()
    {
        return $this->hasOne(OrderAddress::class)->where("type","shipping");
    }
    protected static function booted()
    {
        static::creating(function (Order $order){
            //20240001, 20240002
            $order->number = Order::getNextOrder();
        });
    }
    public static function getNextOrder()
    {
        $year = Carbon::now()->year;
         $number =Order::whereYear("created_at", $year)->max("number");
         if($number){
             return $number+1;
         }
            return $year."0001";
    }
}
