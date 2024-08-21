<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdatePengangkutanRequest extends FormRequest
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
            'transportasi_id' => 'required',
            'pengangkut' => 'required',
            'lokasi_awal' => 'required',
            'lokasi_tujuan' => 'required',
            'jarak' => 'required',
            'liter' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'transportasi_id' => [
                'required' => 'Transportasi tidak boleh kosong'
            ],
            'pengangkut' => [
                'required' => 'Pengangkut tidak boleh kosong'
            ],
            'lokasi_awal' => [
                'required' => 'Lokasi awal tidak boleh kosong'
            ],
            'lokasi_tujuan' => [
                'required' => 'Lokasi tujuan tidak boleh kosong'
            ],
            'jarak' => [
                'required' => 'Jarak tidak boleh kosong'
            ],
            'liter' => [
                'required' => 'Jumlah Liter tidak boleh kosong'
            ],
        ];
    }

    public function prepareForValidation()
    {
        if(Auth::user()->getRoleNames()[0] == 'Administrator'){
            $this->merge([
                'status' => $this->has('status') ? '1' : '0'
            ]);
        }
    }
}
