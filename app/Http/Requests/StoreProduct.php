<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProduct extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            "name_en" => 'required|max:255|unique:products,name_en',
            "name_th" => 'required|max:255|unique:products,name_th',
            "price" => 'required|min:0|numeric',
            "description" => 'max:500',
            "supplier" => 'required|exists:suppliers,id',
            "brand" => 'required|exists:brands,id',
            "category" => 'required|exists:categories,id',
            "unit" => 'required|exists:units,id',
        ];

        if ($this->image) {
            $rules["image"] = 'image|max:500000';
        }

        return $rules;
    }
}
