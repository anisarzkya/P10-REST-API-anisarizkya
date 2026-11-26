<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMataKuliahRequest extends FormRequest
{
    public function authorize(): bool
{
    return true;
}

public function rules(): array
{
    return [
        'kode'     => ['required', 'string', 'max:10', 'unique:mata_kuliah,kode'],
        'nama'     => ['required', 'string', 'min:3', 'max:100'],
        'sks'      => ['required', 'integer', 'between:1,6'],
        'dosen_id' => ['required', 'exists:dosen,id'],
    ];
}
}