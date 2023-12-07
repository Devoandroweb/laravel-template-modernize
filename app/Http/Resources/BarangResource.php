<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BarangResource extends JsonResource
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
            "id_barang"=>$this->id_barang,
            "kode_barang"=>$this->kode_barang,
            "nama_barang"=>$this->nama_barang,
            "satuan"=>$this->satuan,
            "id_kategori"=>$this->kategori?->id_kategori ?? 0,
            "nama_kategori"=>$this->kategori?->nama_kategori ?? "-",
            "minimal_persediaan"=>$this->minimal_persediaan,
            "persediaan"=>$this->persediaan?->jumlah_barang ?? 0,
        ];
    }
}
