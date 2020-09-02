<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSupplier extends FormRequest
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
            "name_en" => 'required|max:255|unique:suppliers,name_en,' .$this->route('supplier'),
            "tel" => 'required|min:10|max:15|unique:suppliers,tel,' . $this->route('supplier'),
            "email" => 'required|email|unique:suppliers,email,' . $this->route('supplier'),
            "address_en" => 'required|max:255',
            "address_th" => 'max:255',
        ];

        if ($this->name_th) {
            $rules["name_th"] = 'max:255|unique:suppliers,name_th,' .$this->route('supplier');
        }

        return $rules;
    }
}
