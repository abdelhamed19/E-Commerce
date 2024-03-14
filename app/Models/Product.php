<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Scopes\theprod;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use NumberFormatter;

class Product extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded=[];
    protected $hidden=[
        "created_at","updated_at","deleted_at",'image'
    ];
    protected $appends=[
        "image_url"
    ];

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
        static::creating(function (Product $product){
            $product->slug = Str::slug($product->name);
        });
    }
    public function Scopeactive(Builder $builder)
    {
        $builder->where("status","=","active");
    }
    public function getImageUrlAttribute()
    {
        if(!$this->image) {
            return asset('images/No-Image.png');
        }
        if(Str::startsWith($this->image,["https://","https://"])){
            return $this->image;
        }
        return asset('storage/'.$this->image);
    }
    public function getComparePricePercentageAttribute()
    {
        if($this->Compare_Price)
        {
            $percentage=100 -(100 * $this->price / $this->Compare_Price);
            return round($percentage);
        }
    }
    public function getNewAttribute()
    {
        if (Carbon::parse($this->created_at)->isToday()) {
            return True;
        }
    }
    public function scopeApi(Builder $builder,$filters)
    {
        $builder->when($filters["store_id"] ?? false,function ($builder, $value){
            $builder->where("store_id","=",$value);
        });
        $builder->when($filters["category_id"] ?? false,function ($builder, $value){
            $builder->where("category_id","=",$value);
        });
        $builder->when($filters["tag"] ?? false,function ($builder, $value){
            $builder->whereRaw("ID IN (SELECT product_id FROM product_tag where tag_id = ?)",$value);
        });
        // $builder->when($filters["tag"] ?? false,function ($builder, $value){
        //   $builder->whereRaw("EXISTS ( SELECT 1 FROM product_tag where tag_id = ?  AND product_id  = products.id)", [$value])
        // });

        // $builder->when($filters["tag"] ?? false,function ($builder, $value){
        //     $builder->whereRaw("ID IN (SELECT product_id FROM product_tag where tag_id = (SELECT id FROM tags where name LIKE ?))",["%$value%"]);
        // });
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
