<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderItems extends Pivot
{
    use HasFactory;
    protected $table = 'order_items';
    public $timestamps = false;
    public $incrementing = true;
    public function product()
    {
        return $this->belongsTo(Product::class)->withDefault(
            ["product_name" => $this->product_name, "price" => $this->price, ]
        );
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
