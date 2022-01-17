<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'nama_pengguna' => 'required|string|max:100',
            'username' => [
                'required',
                'string',
                'alpha_num',
                'max:15',
                Rule::unique('pengguna')->ignore($this->id, 'id_pengguna'),
            ],
            'email' => [
                'required',
                'string',
                'email:rfc',
                Rule::unique('pengguna')->ignore($this->id, 'id_pengguna'),
            ],
            'password' => 'required|string|min:6|confirmed',
            'jabatan' => 'required|in:pemilik,kasir',
        ];
    }
}
