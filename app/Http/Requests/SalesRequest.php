<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Schema;

class SalesRequest extends FormRequest
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
            'id_sales'=>'nullable',
            'id_barang'=>'required',
            'jumlah_sales'=>'required',
            'tanggal_sales'=>'required',
        ];

        return $dataValidate;
    }
    public function failedValidation(Validator $validator)
    {
        // dd($validator->errors()->messages()['kode_barang']);
        $errors = [];
        $errorMessages = $validator->errors()->messages();
        $keys = Schema::getColumnListing('sales');

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
            'id_barang.required' => 'ID Barang tidak boleh kosong',
            'jumlah_sales.required' => 'Jumlah Sales tidak boleh kosong',
            'tanggal_sales.required' => 'Tanggal Sales tidak boleh kosong'
        ];

    }
}
