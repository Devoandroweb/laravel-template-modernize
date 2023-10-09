<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PersediaanByKategoriResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $jumlahTotal = 0;
        foreach ($this->barang as $b) {
            $jumlahTotal += (int)$b->persediaan->jumlah_barang;
        }
        return [
            'nama_kategori'=>$this->nama_kategori,
            'jumlah_macam'=>$this->barang->count(),
            'jumlah_total'=>$jumlahTotal
        ];
    }
}
