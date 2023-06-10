<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShoppingCartRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'product_id' => 'required|exists:products,id|integer',
            'user_id' => 'required|exists:users,id|integer',
            'quantity_sub_product' => 'required|int',
        ];
    }
}