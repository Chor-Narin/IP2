<?php

namespace App\Http\Controllers;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\MinioUploadController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;


use Illuminate\Support\Facades\Storage;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('welcome');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

Route::get('/upload_file', function () { return view('upload_file');})->name('uploads.local');
Route::post('/upload', [UploadController::class, 'upload'])->name('uploads.local');

Route::get('mini/upload_file', function () {
    return view('Mnioupload_file');
})->name('uploads.minio.form');
Route::post('mini/upload', [MinioUploadController::class, 'upload'])->name('uploads.minio.submit');

Route::post('/upload', [ImageController::class, 'store']);


require __DIR__.'/auth.php';
