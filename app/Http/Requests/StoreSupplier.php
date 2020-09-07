<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupplier extends FormRequest
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
            "name_en" => 'required|max:255|unique:suppliers,name_en',
            "tel" => 'required|min:10|max:15|regex:/\(?([0-9]{2,3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/|unique:suppliers,tel',
            "email" => 'required|email|unique:suppliers,email',
            "address_en" => 'required|max:255',
            "address_th" => 'max:255',
        ];

        if ($this->name_th) {
            $rules["name_th"] = 'max:255|unique:suppliers,name_th';
        }

        return $rules;
    }
}
