<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateProfileRequest extends FormRequest
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
            'name' => 'required',
            'value' => 'required',
        ];
        if($this->name == "username"){
            $dataValidate['value'] = 'required|unique:user,username';
        }
        return $dataValidate;
    }
    public function failedValidation(Validator $validator)
    {
        // dd($validator->errors()->messages()['kode_barang']);
        $errors = [];
        $errorMessages = $validator->errors()->messages();
        $keys = ['name','value'];

        foreach ($keys as $key) {
            if(isset($errorMessages[$key])){
                $errors[$key] = collect($errorMessages[$key])->first();
            }
            // Menggunakan nama bidang sebagai kunci dan pesan kesalahan sebagai nilai
        }
        throw new HttpResponseException(responseErrorValidate($errors));
    }
    function message(){
        return [
            'name.required' => 'Name tidak boleh kosong',
            'name.unique' => 'Name sudah tersedia',
            'value.required' => 'Value tidak boleh kosong'
        ];
    }
}
