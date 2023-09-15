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

