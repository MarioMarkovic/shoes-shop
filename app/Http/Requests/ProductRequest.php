<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name'              => 'required|string|max:191',
            'image'             => 'required|image|max:1999',  
            'description'       => 'required|string', 
            'price'             => 'required|numeric|min:1|max:10000.00|regex:/^\d*(\.\d{1,2})?$/',
            'discount'          => 'integer|min:1|digits_between:1,2|nullable', 
            'catalog_number'    => 'required|integer|digits_between:3,10', 
            'category_id'       => 'required|integer',
            'size'              => 'required|array|min:1',
            'size.*'            => 'required|integer|digits:2',
            'quantity'          => 'required|array|min:1',
            'quantity.*'        => 'required|integer|min:0'
        ];
    }
}
