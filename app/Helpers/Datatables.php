<?php

function materiDT(){
    $arrayColumns = [
        "url" => route("datatable.materi"),
        "column" => [
            ['title' => 'No','data' => 'DT_RowIndex', 'orderable'=> false ,'searchable'=> false],
            ['title' => 'Judul','data' => 'judul','name' => 'judul'],
            ['title' => 'Isi','data' => 'isi','name' => 'isi'],
            ['title' => 'Action','data' => 'action','name' => null,'orderable'=> false ,'searchable'=> false],
        ]
    ];
    return $arrayColumns;
}
function latihanDT(){
    $arrayColumns = [
        "url" => route("datatable.latihan"),
        "column" => [
            ['title' => 'No','data' => 'DT_RowIndex', 'orderable'=> false ,'searchable'=> false],
            ['title' => 'Nomor Latihan','data' => 'nomor','name' => 'nomor'],
            ['title' => 'Action','data' => 'action','name' => null,'orderable'=> false ,'searchable'=> false],
        ]
    ];
    return $arrayColumns;
}
function latihanDetailDT(){
    $arrayColumns = [
        "url" => route("datatable.latihan.detail"),
        "column" => [
            ['title' => 'No','data' => 'DT_RowIndex', 'orderable'=> false ,'searchable'=> false],
            ['title' => 'Urutan','data' => 'urutan','name' => 'urutan'],
            ['title' => 'Pertanyaan','data' => 'pertanyaan','name' => 'pertanyaan'],
            ['title' => 'Action','data' => 'action','name' => null,'orderable'=> false ,'searchable'=> false],
        ]
    ];
    return $arrayColumns;
}
function permainanDT(){
    $arrayColumns = [
        "url" => route("datatable.permainan"),
        "column" => [
            ['title' => 'No','data' => 'DT_RowIndex', 'orderable'=> false ,'searchable'=> false],
            ['title' => 'Pertanyaan','data' => 'pertanyaan','name' => 'pertanyaan'],
            ['title' => 'Gambar','data' => 'gambar','name' => 'gambar','orderable'=> false ,'searchable'=> false],
            ['title' => 'Action','data' => 'action','name' => null,'orderable'=> false ,'searchable'=> false],
        ]
    ];
    return $arrayColumns;
}
function siswaDT(){
    $arrayColumns = [
        "url" => route("datatable.siswa"),
        "column" => [
            ['title' => 'No','data' => 'DT_RowIndex', 'orderable'=> false ,'searchable'=> false],
            ['title' => 'NIS','data' => 'nis','name' => 'nis'],
            ['title' => 'Nama','data' => 'nama','name' => 'nama'],
            ['title' => 'Jenis Kelamin','data' => 'jk','name' => 'jk'],
            ['title' => 'Kelas','data' => 'kelas','name' => 'kelas'],
            ['title' => 'Action','data' => 'action','name' => null,'orderable'=> false ,'searchable'=> false],
        ]
    ];
    return $arrayColumns;
}

