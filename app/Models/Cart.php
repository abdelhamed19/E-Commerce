<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Observers\CartObserver;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $incrementing = false;
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault(
            [
                'name' => 'Guest',]
        );
    }
    public static function booted()
    {
        Static::observe(CartObserver::class);
        static::addGlobalScope('user', function ($builder) {
            $builder->where("cookie_id", "=", Cart::getCookie());
        });
    }
    public static function getCookie()
    {
        $cookie_id=Cookie::get("cart");
        if(!$cookie_id){
            $cookie_id=Str::uuid();
            Cookie::queue("cart",$cookie_id,60*24*30);
        }
        return $cookie_id;
    }
}
