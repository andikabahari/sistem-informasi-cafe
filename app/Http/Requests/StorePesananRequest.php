<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePesananRequest extends FormRequest
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
            'nama_pelanggan' => 'required|string|max:100',
            'tanggal_pesanan' => 'required|date',
            'banyak' => 'required|array',
            'banyak.*' => 'nullable|integer',
            'total' => 'required|numeric|gt:0',
            'tunai' => 'required|numeric|gte:total',
            'kembali' => 'required|numeric',
        ];
    }
}
