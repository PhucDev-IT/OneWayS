<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
        'fullname' =>'required',
        'birthOfDay' => 'required',
        'gender' => 'required',
        'email' => 'required|email|unique:users,email',
        'image'=>'image',
        'password' => 'required|min:6|max:20',
        'role_id' => 'required'
        ]; 
    }
}
