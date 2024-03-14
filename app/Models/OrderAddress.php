<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;
    public function getNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }
}
