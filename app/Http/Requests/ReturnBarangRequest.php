<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Schema;

class ReturnBarangRequest extends FormRequest
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
            'id_data_pengembalian_barang'=>'nullable',
            'id_barang'=>'required',
            'jumlah_barang'=>'required',
            'tanggal_pengembalian'=>'required',
        ];
        if(is_null($this->id_sales)){
            $dataValidate['id_barang'] = 'exists:barang,id_barang|required';
        }
        return $dataValidate;
    }
    public function failedValidation(Validator $validator)
    {
        // dd($validator->errors()->messages()['kode_barang']);
        $errors = [];
        $errorMessages = $validator->errors()->messages();
        $keys = Schema::getColumnListing('pengembalian_barang');

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
            'id_barang.exists' => 'Kode Barang tidak tersedia',
            'id_barang.required' => 'Kode Barang tidak boleh kosong',
            'jumlah_barang.required' => 'Jumlah Barang tidak boleh kosong',
            'tanggal_pengembalian.required' => 'Tanggal Pengembalian tidak boleh kosong'
        ];

    }
}
