<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class CategoryFilter implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
       
    //     if (request("name") ?? false)
    //    {
    //        $builder->where("name","LIKE","%".request('name')."%");
    //    }
    //    if (request("status") ?? false)
    //    {
    //        $builder->where("status",request("status"));
    //    }

    
    $builder->when(request("name") ?? false,function ($builder, $value){
        $builder->where("name","LIKE","%".request("name")."%");
    });

    $builder->when(request("status") ?? false,function ($builder, $value){
        $builder->where("status","=",request("status"));
    });
        
    }
}
