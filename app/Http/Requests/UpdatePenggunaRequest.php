<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePenggunaRequest extends FormRequest
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
            'nama_pengguna' => 'required|string|max:100',
            'username' => 'required|string',
            'password' => 'required|string',
            'jabatan' => 'required|string',
        ];
    }
}
