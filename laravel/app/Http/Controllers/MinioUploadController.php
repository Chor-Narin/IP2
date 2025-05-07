<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
class MinioUploadController extends Controller
{
    public function upload(Request $request)
{
    $request->validate([
        'document' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    $path = $request->file('document')->store('', 'minio');

    $disk = Storage::disk('minio');
    $tempPath = storage_path('app/temp_' . Str::random(10));

    // Save a temp copy to get the mime type
    file_put_contents($tempPath, $disk->get($path));
    $mimeType = mime_content_type($tempPath);
    unlink($tempPath); // Clean up

    $stream = $disk->readStream($path);

    return response()->stream(function () use ($stream) {
        fpassthru($stream);
    }, 200, [
        'Content-Type' => $mimeType,
        'Content-Disposition' => 'inline; filename="' . basename($path) . '"'
    ]);
}
}