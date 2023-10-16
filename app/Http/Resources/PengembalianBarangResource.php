<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PengembalianBarangResource extends JsonResource
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
            "id_data_pengembalian_barang" => $this->id_data_pengembalian_barang,
            "nama_barang" => $this->barang?->nama_barang,
            "jumlah_barang" => $this->jumlah_barang,
            "tanggal_pengembalian" => convertDate($this->tanggal_pengembalian,true,false),
        ];
    }
}
