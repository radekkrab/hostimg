<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class ZipController extends Controller
{
    public function zipped($img_name)
    {
        $path = Storage::path('public/'.$img_name);

        $zip = new ZipArchive();
        $zip->open('archive.zip', ZipArchive::CREATE);
        $zip->addFile($path, $img_name);
        $zip->close();
    }
}
