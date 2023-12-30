<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function user()
    {
        return $this->belongsTo(User::class,"user_id")->withDefault();
    }
    public static function rules()
    {
        return [
            "firstName" =>["required","max:30","min:2","string"],
            "lastName" =>["required","max:30","min:2","string"],
            "birthday" =>["required","date"],
            "gender"=>["in:Male,Female","required"],
            "country"=>["required","max:2","string"],
            "street"=>["required","min:2","max:50","string"],
            "postalCode"=>["required","int"],
        ];
    }
}
