<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Schema;
use Illuminate\Contracts\Validation\Validator;

class KategoriRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $dataValidate = [
            'id_kategori'=>'nullable',
            'kode_kategori'=>'required',
            'nama_kategori'=>'required',
        ];
        if(is_null($this->id_kategori)){
            $dataValidate['kode_kategori'] = 'unique:kategori,kode_kategori|required';
        }
        return $dataValidate;
    }
    public function failedValidation(Validator $validator)
    {
        // dd($validator->errors()->messages()['kode_barang']);
        $errors = [];
        $errorMessages = $validator->errors()->messages();
        $keys = Schema::getColumnListing('kategori');

        foreach ($keys as $key) {
            if(isset($errorMessages[$key])){
                $errors[$key] = collect($errorMessages[$key])->first();
            }
            // Menggunakan nama bidang sebagai kunci dan pesan kesalahan sebagai nilai
        }
        throw new HttpResponseException(responseErrorValidate($errors));
    }

    public function messages()

    {
        return [
            'kode_kategori.unique' => 'Kode Kategori sudah tersedia',
            'kode_kategori.required' => 'Kode Kategori tidak boleh kosong',
            'nama_kategori.required' => 'Nama Kategori tidak boleh kosong',
        ];

    }
}
