<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomer extends FormRequest
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
        return [
            "name" => 'required|max:255|unique:customers,name,' .$this->route('customer'),
            "coordinator" => 'required|max:255|unique:customers,coordinator,' .$this->route('customer'),
            "tel" => 'required|min:10|max:15|regex:/\(?([0-9]{2,3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/|unique:customers,tel,' .$this->route('customer'),
            "email" => 'required|email|unique:customers,email,' .$this->route('customer'),
            "address" => 'required|max:255',
            'note' => 'max:500',
        ];
    }
}
