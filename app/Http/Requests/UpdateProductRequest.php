<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'list_price' => 'required|numeric|min:1',
            'sale_price' => 'required|numeric|min:1|lt:list_price',
            'description' => 'required',
            'quantity'=>'required|numeric|min:1',
            'cover_image' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'additional_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ];
    }
}
