<?php

function uploadFile($dir, $file)
{
    $result = null;
    $namaFile = time() . "_" . $file->getClientOriginalName();
    // $ext = $file->getClientOriginalExtension();
    $filename = $file->move($dir, $namaFile);
    $result = $filename->getFileName();
    return $result;
}
function responseSuccess($data){
    return response()->json([
        'status'=>true,
        'message'=>'Success !!',
        'data' => $data
    ],200);
}
function responseFailed($failedMsg){
    return response()->json([
        'status'=>false,
        'message'=>'Failed !!',
        'data' => [
            'error' => $failedMsg
        ]
    ],500);
}
function responseErrorValidate($validator){
    return response()->json([
        'status'=>false,
        'message'=>'Validation Failed!!',
        'data' => $validator
    ],422);
}
function uploadImage($dir, $file)
{
    $result = null;
    $namaFile = time() . "_" . generateRandomString(20) . "." . $file->extension();
    $file->move($dir, $namaFile);
    $result = $namaFile;
    return $result;
}
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function convertDate($date, $withDay = true, $withMinute = true)
{
    if ($date != null ||  $date != "") {
        $nama_hari    =   array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu");
        $nama_bulan   =   array(
            1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        );
        $tahun        =   substr($date, 0, 4);
        $bulan        =   $nama_bulan[(int)substr($date, 5, 2)];
        $tanggal      =   substr($date, 8, 2);

        $text         =   "";

        if ($withDay) {

            $urutan_hari  =   date('w', mktime(0, 0, 0, substr($date, 5, 2), $tanggal, $tahun));
            $hari         =   $nama_hari[$urutan_hari];
            $text         .=  $hari . ", ";
        }

        $text         .= $tanggal . " " . $bulan . " " . $tahun;

        if ($withMinute) {

            $jam    =   substr($date, 11, 2);
            $menit  =   substr($date, 14, 2);

            $text   .=  ", " . $jam . ":" . $menit;
        }
    } else {

        $text = "-";
    }
    return $text;
}
