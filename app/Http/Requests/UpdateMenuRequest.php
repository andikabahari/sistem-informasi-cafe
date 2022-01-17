<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMenuRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id_pengguna' => 'nullable|integer',
            'nama_menu' => 'required|string|max:100',
            'harga' => 'required|numeric',
            'aktif' => 'nullable|boolean',
            'gambar' => 'nullable|image|file|max:1024',
        ];
    }
}
