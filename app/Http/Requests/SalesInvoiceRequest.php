<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalesInvoiceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'invoice_number' => 'required',
            'user_id' => 'required|exist:users,id|int',
            'shopping_cart_id' => 'required|exist:shopping_carts,id|int',
            'shipping_id' => 'required|exists:shippings,id',
        ];
    }
}