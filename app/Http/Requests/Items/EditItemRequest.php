<?php

namespace App\Http\Requests\Items;

use App\Http\Requests\Request;

class EditItemRequest extends Request
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
            'title',
            'description',
            'short_description',
            'price', 
            'quantity',
            'status',
            'main_image_id'
        ];
    }
}
