<?php

namespace App\Http\Requests\Items; 

use App\Http\Requests\Request;

class CreateItemRequest extends Request
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
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'status' => 'required',
            'category_id' => 'required',
            'collection_id' => 'required',
            'item_image' => 'required',
            'alt' => 'required'
        ];
    }

}
