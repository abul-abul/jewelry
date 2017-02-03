<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\Request;

class EditAccountRequest extends Request
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
            'firstName' => 'required|max:255|not_in:numeric|regex:/^[\pL\s\-]+$/u',
            'lastName' => 'required|max:255|not_in:numeric|regex:/^[\pL\s\-]+$/u',
            'Email' => 'required|email', 
        ];
    }

}
