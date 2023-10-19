<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PersediaanResource extends JsonResource
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
            "id_persediaan" => $this->id_persediaan,
            "nama_barang" => $this->barang?->nama_barang ?? "-",
            "satuan" => $this->barang?->satuan ?? "-",
            "jumlah_barang" => $this->jumlah_barang
        ];
    }
}
