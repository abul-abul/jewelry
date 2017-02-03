<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\Request;

class EditShippingAddress extends Request
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
            'country' => 'max:255',
            'city' => 'required|max:255|not_in:numeric|regex:/^[\pL\s\-]+$/u',
            'postal_code' => 'required',
            'address' =>'required',
        ];
    }
}

