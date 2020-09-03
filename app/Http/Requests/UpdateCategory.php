<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategory extends FormRequest
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
            "name_en" => 'required|max:255|unique:categories,name_en,' .$this->route('category'),
        ];

        if ($this->name_th) {
            $rules["name_th"] = 'max:255|unique:categories,name_th,' .$this->route('category');
        }

        return $rules;
    }
}
