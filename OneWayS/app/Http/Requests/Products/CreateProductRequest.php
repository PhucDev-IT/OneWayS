<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'img_preview' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'name' => 'required|min:10',
            'description' => 'required',
            'price' => 'required|min:1',
            'password' => 'required|min:6|max:20',
        ];
    }
}
