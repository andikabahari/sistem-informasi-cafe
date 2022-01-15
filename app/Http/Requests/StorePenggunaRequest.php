<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePenggunaRequest extends FormRequest
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
            'username' => 'required|string|max:15|unique:pengguna',
            'password' => 'required|string|min:6|confirmed',
            'jabatan' => 'required|in:pemilik,kasir',
        ];
    }
}
