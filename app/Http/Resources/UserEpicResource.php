<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserEpicResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id_user" => $this->id_user,
            "nama_toko" => $this->nama_toko,
            "nama" => $this->nama,
            "email" => $this->email,
            "username" => $this->username,
            "role" => $this->role,
            "foto" => url('public/images/user/'.$this->foto),
            "alamat" => $this->alamat,
            "ttl" => $this->ttl,
            "tempat_lahir" => $this->tempat_lahir,
            "jk" => $this->jk,
            "no_tlp" => $this->no_tlp,
        ];
    }
}
