<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImgController extends Controller
{
    public function upload(Request $request) {
        if ($request->hasFile('img')) {
            $images = $request->file('img');
            foreach ($images as $img) {
               $imgName = $img->getClientOriginalName();
                if (preg_match('/[А-Яа-яЁё]/u', $imgName)) {
                    $imgName = Str::transliterate($imgName);
                } else {
                   $imgName = $imgName;
                }

                $imgName = strtolower($imgName);
                $imgName = $this->makeNameUnique($imgName);
                $img->storeAs('public/', $imgName);
               Image::create([
                  'img_name' => $imgName,
                   'img_path' => 'storage/'.$imgName,
                ]);
            }

            return 'Изображения успешно сохранены.';
        } else {
            return 'Изображения не найдены.';
        }
    }

    private function makeNameUnique($name)
    {
        $i = 1;
        $originalName = $name;
        while (Storage::exists('public/' . $name)) {
            $name = pathinfo($originalName, PATHINFO_FILENAME) . '-' . $i . '.' . pathinfo($originalName, PATHINFO_EXTENSION);
            $i++;
        }
        return $name;
    }
}
