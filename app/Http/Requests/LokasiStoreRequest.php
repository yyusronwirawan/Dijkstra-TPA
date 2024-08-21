<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LokasiStoreRequest extends FormRequest
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
            'coordinate' => 'required',
            'nama' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'coordiante.required' => 'Koordinat tidak boleh kosong',
            'nama.required' => 'Nama sekolah tidak boleh kosong',
        ];
    }
}
