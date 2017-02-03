<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\Request;

class EditContactInformation extends Request
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
            'first_name' => 'required|max:255|alpha',
            'last_name' => 'required|max:255|alpha',
            'country' => 'max:255',
            'city' => 'required|max:255|not_in:numeric|regex:/^[\pL\s\-]+$/u',
            'postal_code' => 'required',
            'phone_number' =>'required|regex:/(^[0-9 ]+$)+/',
        ];
    }

    // public function response(array $Arr)
    // {
    //     dd($Arr);
    // }
}
