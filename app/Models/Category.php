<?php

namespace App\Models;

use App\Models\Scopes\CategoryFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;
use \Illuminate\Database\Eloquent\Builder;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded=[];


    public function products()
    {
        return $this->hasMany(Product::class,"category_id");
    }
    public function children()
    {
        return $this->hasMany(Category::class,"parent_id");
    }
    public function parent()
    {
        return $this->belongsTo(Category::class,"parent_id","id")->withDefault();
    }


    // Local Scope to get active Categories only
//    public function scopeActive(\Illuminate\Database\Eloquent\Builder $builder)
//    {
//        $builder->where("status","=","inactive");
//    }

    // Local Scope to get active Categories and name searched for
    public function scopefilter(Builder $builder,$filter)
    {
        // Way one
    //    if ($filter["name"] ?? false)
    //    {
    //        $builder->where("name","LIKE","%{$filter['name']}%");
    //    }
    //    if ($filter["status"] ?? false)
    //    {
    //        $builder->where("status",$filter['status']);
    //    }

        // Way two
        $builder->when($filter["name"] ?? false,function ($builder, $value){
            $builder->where("name","LIKE","%{$value}%");
        });

        $builder->when($filter["name"] ?? false,function ($builder, $value){
            $builder->orWhere("description","LIKE","%{$value}%");
        });

        $builder->when($filter["status"] ?? false,function ($builder, $value){
            $builder->where("status","=",$value);
        });
    }

    // Global Scope
    // public static function booted()
    // {
    //     static::addGlobalScope("cat",new CategoryFilter);
    // }

}
