<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PenjualanResource extends JsonResource
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
            "id_penjualan" => $this->id_penjualan,
            "nama_barang" => $this->barang?->nama ?? "- Barang sudah di hapus -",
            "tanggal_penjualan" => convertDate($this->tanggal_penjualan,true,false),
            "jumlah_penjualan" => $this->jumlah_penjualan
        ];
    }
}
