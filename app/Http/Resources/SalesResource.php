<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SalesResource extends JsonResource
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
            "id_sales" => $this->id_sales,
            "nama_barang" => $this->barang?->nama_barang ?? "-",
            "satuan"=> $this->barang?->satuan ?? "-",
            "jumlah_sales" => $this->jumlah_sales,
            "tanggal_sales" => convertDate($this->created_at,true,false)
        ];
    }
}
