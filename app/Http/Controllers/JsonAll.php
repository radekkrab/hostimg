<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class JsonAll extends Controller
{
    public function index()
    {
        $files = Image::all();
        return response()->json($files);
    }
    public function getFileById($id)
    {
        $file = Image::where('id', $id)->get();

        return response()->json($file);
    }
}
