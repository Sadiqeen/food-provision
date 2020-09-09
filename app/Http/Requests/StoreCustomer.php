<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomer extends FormRequest
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
            "name_en" => 'required|max:255|unique:customers,name_en',
            "coordinator_en" => 'required|max:255|unique:customers,coordinator_en',
            "tel" => 'required|min:10|max:15|regex:/\(?([0-9]{2,3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/|unique:customers,tel',
            "email" => 'required|email|unique:customers,email',
            "address_en" => 'required|max:255',
            "address_th" => 'max:255',
            'note' => 'max:500',
        ];

        if ($this->name_th) {
            $rules["name_th"] = 'max:255|unique:customers,name_th';
        }

        if ($this->coordinator_th) {
            $rules["coordinator_th"] = 'max:255|unique:customers,name_th';
        }

        return $rules;
    }
}
