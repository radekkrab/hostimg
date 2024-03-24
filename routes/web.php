<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ImgController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ZipController;
use App\Http\Controllers\JsonAll;


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    $imgs = \App\Models\Image::all();
    $imgs->toArray();

    return Inertia::render('Dashboard', compact('imgs'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/loadimg', function () {
    return Inertia::render('Loadimg');
})->middleware(['auth', 'verified'])->name('loadimg');

Route::post('/storeimg', [ImgController::class, 'upload']);

Route::get('/zip/{img_name}', [ZipController::class, 'zipped']);

Route::get('/json', [JsonAll::class, 'index' ])->name('json');
Route::get('/json/{id}', [JsonAll::class, 'getFileById' ]);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
