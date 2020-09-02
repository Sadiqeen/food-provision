<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBrand extends FormRequest
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
            "name_en" => 'required|max:255|unique:brands,name_en,' .$this->route('brand'),
        ];

        if ($this->name_th) {
            $rules["name_th"] = 'max:255|unique:brands,name_th,' .$this->route('brand');
        }

        return $rules;
    }
}
