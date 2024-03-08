<?php

namespace App\Http\Requests\Vouchers;

use Illuminate\Foundation\Http\FormRequest;

class VoucherCreateRequest extends FormRequest
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
            'name' => 'required|max:255',
            'description'=> 'required',
            'discount' => 'required|min:1',
            'type' => 'required',
            'quantity' => 'required|min:1',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ];
    }
}
