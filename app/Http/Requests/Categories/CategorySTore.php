<?php

namespace App\Http\Requests\Categories;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CategorySTore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules($id=0): array
    {
        return [
            "name"=>[
                "required",
                "string",
                "min:2",
                "max:255",
                    Rule::unique('categories','name')->ignore($id),
                    function ($attribute,$value,$fails)
                    {
                        $forb=["laravel","php","html","java"];
                        if (in_array(strtolower($value),$forb))
                        {
                            $fails("This Name Is forbidden");
                        }
                    }
                ],
                "slug"=>["nullable","unique:categories,slug"],
                "parent_id"=>["nullable","int","exists:categories,id"],
                "image"=>"image|max:1048576|dimensions:min_width=100,min_height=100",
                "status"=>"in:active,inactive",
                "description"=>"required|string|min:2|max:500"
        ];
    }
}
