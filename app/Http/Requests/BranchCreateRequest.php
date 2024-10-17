<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BranchCreateRequest extends FormRequest
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
            'name' => 'required|string|min:2|max:100',
            'address' => 'required|string|min:5|max:255',
            'phone' => 'nullable|string|max:15',
            // 'days_open' => 'nullable|string|regex:/^(Senin|Selasa|Rabu|Kamis|Jumat|Sabtu|Minggu)\s?-\s?(Senin|Selasa|Rabu|Kamis|Jumat|Sabtu|Minggu)$/',
            // 'hours_open' => 'nullable|string|regex:/^\d{1,2}:\d{2}\s?-\s?\d{1,2}:\d{2}$/',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'category_id' => 'required|exists:categories,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama cabang harus diisi.',
            'name.string' => 'Nama cabang harus berupa teks.',
            'name.min' => 'Nama cabang harus memiliki minimal 2 karakter.',
            'name.max' => 'Nama cabang tidak boleh lebih dari 100 karakter.',

            'address.required' => 'Alamat cabang harus diisi.',
            'address.string' => 'Alamat cabang harus berupa teks.',
            'address.min' => 'Alamat cabang harus memiliki minimal 5 karakter.',
            'address.max' => 'Alamat cabang tidak boleh lebih dari 255 karakter.',

            'phone.string' => 'Nomor telepon harus berupa teks.',
            'phone.max' => 'Nomor telepon tidak boleh lebih dari 15 karakter.',

            'days_open.string' => 'Hari buka harus berupa teks.',
            'days_open.regex' => 'Hari buka tidak valid. Gunakan format yang sesuai.',

            'hours_open.string' => 'Jam buka harus berupa teks.',
            'hours_open.regex' => 'Jam buka tidak valid. Gunakan format jam yang sesuai (misalnya, "09:00 - 17:00").',

            'latitude.numeric' => 'Latitude harus berupa angka.',
            'latitude.between' => 'Latitude harus antara -90 dan 90.',

            'longitude.numeric' => 'Longitude harus berupa angka.',
            'longitude.between' => 'Longitude harus antara -180 dan 180.',

            'category_id.required' => 'Kategori harus dipilih.',
            'category_id.exists' => 'Kategori yang dipilih tidak valid.',
        ];
    }
}
