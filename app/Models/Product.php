<?php

namespace App\Models;

use App\Models\Scopes\theprod;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded=[];

    public function category()
    {
       return $this->belongsTo(Category::class,"category_id","id")->withDefault();
    }
    public function store()
    {
        return $this->belongsTo(Store::class,"store_id","id")->withDefault();
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function scopefilter(Builder $builder,$filter)
    {
        $builder->when($filter["name"] ?? false,function ($builder, $value){
            $builder->where("name","LIKE","%{$value}%");
        });

        $builder->when($filter["status"] ?? false,function ($builder, $value){
            $builder->where("status","=",$value);
        });
    }
    public static function booted()
    {
        static::addGlobalScope("theprod",new theprod);
    }
    public static function rules($id=0)
    {
        return [
            "name"=> ["required","string","min:2","max:30"],
            "description"=> ["required","string","min:2","max:255"],
            "price"=> ["required","int"],
            "Compare_Price"=> ["required","int"],
            "status"=> ["in:active,draft,archvied"],
            "category_id"=> ["required","int"],

        ];
    }

    public function Scopeactive(Builder $builder)
    {
        $builder->where("status","=","active");
    }


}


    //Local scope for products
    // public function Scopetheproducts(Builder $builder)
    // {
    //     $user=Auth::user();
    //     if($user->store_id)
    //     {
    //         $builder->where("store_id","=",$user->store_id);
    //     }
    //     else{
    //         $builder->paginate(10);
    //     }
    // }
