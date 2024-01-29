<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdate extends FormRequest
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
    public function rules(): array
    {
        return [
            "name"=> ["required","string","min:2","max:255"],
            "description"=> ["required","string","min:2","max:255"],
            "price"=> ["required","numeric"],
            "Compare_Price"=> ["nullable","numeric"],
            "status"=> ["in:active,draft,archvied"],
            "category_id"=> ["required","int"],
            "tags"=>["nullable","string"]
        ];
    }
}
