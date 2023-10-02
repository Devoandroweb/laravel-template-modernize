<?php

namespace App\Http\Requests;

use App\Models\MBarang;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;
class BarangRequest extends FormRequest
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
            'old_kode_barang'=>'nullable',
            'nama_barang'=>'required',
            'satuan'=>'required',
            'id_kategori'=>'required',
            'minimal_persediaan'=>'required'
        ];
        if($this->is_create == 1){
            $dataValidate['kode_barang'] = 'unique:barang,kode_barang|required';
        }else{
            $dataValidate['old_kode_barang'] = ['required',Rule::unique('kode_barang')->ignore($this->kode_barang)];
        }
        return $dataValidate;
    }
    public function failedValidation(Validator $validator)
    {
        // dd($validator->errors()->messages()['kode_barang']);
        $errors = [];
        $errorMessages = $validator->errors()->messages();
        $keys = Schema::getColumnListing('barang');

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
            'kode_barang.unique' => 'Kode Barang sudah tersedia',
            'kode_barang.required' => 'Nama Barang tidak boleh kosong',
            'nama_barang.required' => 'Nama Barang tidak boleh kosong',
            'id_kategori.required' => 'Kategori tidak boleh kosong',
            'minimal_persediaan.required' => 'Minimal Persediaan tidak boleh kosong',
            'satuan.required' => 'Satuann tidak boleh kosong'
        ];

    }
}
