<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\Request;

class ChangePasswordRequest extends Request
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
            'new_password' => 'required|confirmed|min:6',
            'new_password_confirmation' => 'required|min:6',
        ];
    }

    /**
     * Make changes before sending the request.
     * 
     * @return array
     */
    public function inputs()
    {
        $inputs = $this->all();
        $inputs['new_password'] = bcrypt($inputs['new_password']);
        return $inputs;
    }

    // public function response(array $Arr)
    // {
    //     dd($Arr);
    // }
}
