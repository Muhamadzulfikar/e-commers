<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShippingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'shipping_type' => 'required|string|min:5|max:255',
            'partner_name' => 'required|string|min:5|max:255',
            'estimation_day' => 'required|string|min:5|max:255',
            'price' => 'required|int',
        ];
    }
}