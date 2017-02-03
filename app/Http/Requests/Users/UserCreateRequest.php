<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\Request;

class UserCreateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return redirect()->back()->withInput();
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
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'country' => 'required',
            'city' => 'required|alpha',
            'address' => 'required',
            'postal_code' => 'required',
            'phone_number' => 'regex:/(^[0-9 ]+$)+/',

        ];
    }

    /**
     * Make some changes before sending the request.
     *
     * @return array
     */
    public function inputs()
    {
        $inputs = $this->all();
        $inputs['password'] = bcrypt($inputs['password']);
        return $inputs;
    }
}
