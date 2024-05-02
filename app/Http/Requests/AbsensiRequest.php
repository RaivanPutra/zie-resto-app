<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AbsensiRequest extends FormRequest
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
            'namaKaryawan' => 'required',
            'tanggalMasuk' => 'required',
            'waktuMasuk' => 'required',
            'status' => 'required',
            'waktuKeluar' => 'required',
        ];
    }

    public function massages()
    {
        return [
            'namaKaryawan.required' => 'Nama maryawan harus diisi.',
            'tanggalMasuk.required' => 'Tanggal masuk harus diisi.',
            'waktuMasuk.required' => 'Waktu masuk harus diisi.',
            'status.required' => 'Status harus diisi.',
            'waktuKeluar.required' => ' Waktu selesai kerja harus diisi.',
        ];
    }
}
