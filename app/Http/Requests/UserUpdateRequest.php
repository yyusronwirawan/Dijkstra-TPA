<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
            'name' => 'required',
            'email' => ['required','email',Rule::unique('users')->ignore($this->email,'email')],
            'password' => 'required',
            'role' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name' => [
                'required' => 'Maaf nama tidak boleh kosong'
            ],
            'email' => [
                'required' => 'Email tidak boleh kosong',
                'unique' => 'Email sudah terdaftar'
            ],
            'password' => [
                'required' => 'Password tidak boleh kosong'
            ],
            'role' => [
                'required' => 'Role tidak boleh kosong'
            ],
        ];
    }
}
