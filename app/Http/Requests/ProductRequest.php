<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'product_category_id' => 'required|exists:product_categories,id|integer',
            'product_name' => 'required|string|min:5|max:255',
            'product_price' => 'required|integer',
            'short_description' => 'required|string|min:5|max:100',
            'weight' => 'required|numeric',
            'image_product' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
}