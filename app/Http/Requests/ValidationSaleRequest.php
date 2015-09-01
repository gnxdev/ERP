<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ValidationProductsRequest extends Request
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
            'seller_id'   => 'integer',
            'customer_id' => 'integer',
            'shipping_id' => 'integer'
        ];
    }
}