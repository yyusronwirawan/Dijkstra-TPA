<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransportasiRequest extends FormRequest
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
            'merk' => 'required',
            'plat' => 'required',
            'muatan' => 'required',
            'pemilik' => 'required',
            'thn' => 'required',
            'warna' => 'required',
        ];
    }
    public function messages()
    {
        return[
            'merk' => [
                'required' => 'Merk tidak boleh kosong'
            ],
            'plat' => [
                'required' => 'Plat tidak boleh kosong'
            ],
            'muatan' => [
                'required' => 'Muatan tidak boleh kosong'
            ],
            'pemilik' => [
                'required' => 'Pemilik tidak boleh kosong'
            ],
            'thn' => [
                'required' => 'Tahun tidak boleh kosong'
            ],
            'warna' => [
                'required' => 'Warna tidak boleh kosong'
            ],
        ];
    }
}
