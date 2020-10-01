<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;

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
        $user = User::where('customer_id', $this->route('customer'))->first();

        $rules = [
            "name" => 'required|max:255|unique:customers,name,' .$this->route('customer'),
            "coordinator" => 'required|max:255|unique:users,name,' .$user->id,
            "tel" => 'required|min:10|max:15|regex:/\(?([0-9]{2,3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/|unique:customers,tel,' .$this->route('customer'),
            "email" => 'required|email|unique:users,email,' .$user->id,
            "address" => 'required|max:255',
            'note' => 'max:500',
        ];

        if ($this->password) {
            $rules['password'] = 'required|string|min:8|confirmed';
        }

        return $rules;
    }
}
