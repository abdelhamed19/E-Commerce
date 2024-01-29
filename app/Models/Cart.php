<?php

namespace App\Models;

use App\Observers\CartObserver;
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
    }
}
