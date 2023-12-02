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
function sendFCM($user,$dataPayload) {
    if($user->fcm == ""){
        // dd($user);
        return false;
    }
    // FCM API Url
    $url = 'https://fcm.googleapis.com/fcm/send';

    // Put your Server Key here
    $apiKey = "AAAAgDywGjc:APA91bGXYkNgYcz5PWyI77FxwmOw8LSjHjlqMdlrS2zZv7kwhdDCxnUXcrlD3OVX-6hnNulQtzAY6S4BuNe-2fdAB52XMhnviNGRI8ybm7GE5VxZdDIaOubgnjceR9n4cLJ9jHk6-11F";

    // Compile headers in one variable
    $headers = array (
      'Authorization:key=' . $apiKey,
      'Content-Type:application/json'
    );

    // Add notification content to a variable for easy reference
    $notifData = [
      'title' => "Test Title",
      'body' => "Test notification body",
      //  "image": "url-to-image",//Optional
      'click_action' => "activities.NotifHandlerActivity" //Action/Activity - Optional
    ];



    // Create the api body
    $apiBody = [
      'notification' => $notifData,
      'data' => $dataPayload, //Optional
      'time_to_live' => 600, // optional - In Seconds
      //'to' => '/topics/mytargettopic'
      //'registration_ids' = ID ARRAY
      'to' => $user->fcm
    ];

    // Initialize curl with the prepared headers and body
    $ch = curl_init();
    curl_setopt ($ch, CURLOPT_URL, $url);
    curl_setopt ($ch, CURLOPT_POST, true);
    curl_setopt ($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt ($ch, CURLOPT_POSTFIELDS, json_encode($apiBody));

    // Execute call and save result
    $result = curl_exec($ch);
    // print($result);
    // Close curl after call
    curl_close($ch);
    addLogFB($result,$dataPayload);
  }
  function addLogFB($result,$data){
    // dd("okasda");
    $logTxt = date('Y-m-d H:i:s')."| Status: ".$result." | send : ".json_encode($data);
    file_put_contents('logs.txt', $logTxt . PHP_EOL, FILE_APPEND | LOCK_EX);
  }
