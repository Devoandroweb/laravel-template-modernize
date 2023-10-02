<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Schema;

class PenjualanRequest extends FormRequest
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

    public function rules()
    {
        $dataValidate = [
            'id_penjualan'=>'nullable',
            'id_barang'=>'required',
            'jumlah_penjualan'=>'required',
            'tanggal_penjualan'=>'required',
        ];

        return $dataValidate;
    }
    public function failedValidation(Validator $validator)
    {
        // dd($validator->errors()->messages()['kode_barang']);
        $errors = [];
        $errorMessages = $validator->errors()->messages();
        $keys = Schema::getColumnListing('penjualan');

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
            'kode_barang.required' => 'Kode Barang tidak boleh kosong',
            'jumlah_penjualan.required' => 'Jumlah Penjualan tidak boleh kosong',
            'tanggal_penjualan.required' => 'Tanggal Penjualan tidak boleh kosong'
        ];

    }
}
