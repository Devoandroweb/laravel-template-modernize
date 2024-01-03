<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Schema;

class UserEpicRequest extends FormRequest
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
            'id_user'=>'nullable',
            'nama_toko'=>'required',#
            'nama'=>'nullable',
            'email'=>'nullable',
            'role'=>'required',#
            'username'=>'required',#
            'password'=>'required',#
            'alamat'=>'nullable',
            'ttl'=>'nullable',
            'tempat_lahir'=>'nullable',
            'jk'=>'nullable',
            'no_tlp'=>'nullable',
            'is_active'=>'nullable',
            'is_login'=>'nullable',
        ];
        if(is_null($this->id_user)){
            $dataValidate['username'] = 'unique:user,username|required';
        }
        return $dataValidate;
    }
    public function failedValidation(Validator $validator)
    {
        // dd($validator->errors()->messages()['kode_barang']);
        $errors = [];
        $errorMessages = $validator->errors()->messages();
        $keys = Schema::getColumnListing('user');

        foreach ($keys as $key) {
            if($key != 'foto'){
                if(isset($errorMessages[$key])){
                    $errors[$key] = collect($errorMessages[$key])->first();
                }
            }
            // Menggunakan nama bidang sebagai kunci dan pesan kesalahan sebagai nilai
        }
        throw new HttpResponseException(responseErrorValidate($errors));
    }

    public function messages()
    {
        return [
            'username.unique' => 'Username sudah tersedia',
            'username.required' => 'Username tidak boleh kosong',
            'nama_toko.required' => 'Nama Toko tidak boleh kosong',
            'nama.required' => 'Nama Pengguna tidak boleh kosong',
            'role.required' => 'Role tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
            'alamat.required'=>'Alamat tidak boleh kosong',
            'ttl.required'=>'Tanggal Lahir tidak boleh kosong',
            'tempat_lahir.required'=>'Tempat Lahir tidak boleh kosong',
            'jk.required'=>'Jenis Kelamin tidak boleh kosong',
            'no_tlp.required'=>'No Telepon tidak boleh kosong'
        ];

    }
}
