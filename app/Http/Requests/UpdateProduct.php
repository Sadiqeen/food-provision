<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProduct extends FormRequest
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
            "name_en" => 'required|max:255|unique:products,name_en,' . $this->route('product'),
            "price" => 'required|min:0|numeric',
            "description_en" => 'max:500',
            "description_th" => 'max:500',
            "supplier" => 'required|exists:suppliers,id',
            "brand" => 'required|exists:brands,id',
            "category" => 'required|exists:categories,id',
            "unit" => 'required|exists:units,id',
        ];

        if ($this->image) {
            $rules["image"] = 'image|max:50000';
        }

        if ($this->name_th) {
            $rules["name_th"] = 'max:255|unique:products,name_th,' . $this->route('product');
        }

        return $rules;
    }
}
