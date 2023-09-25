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

