<!-- <?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048'
        ]);

        $image = $request->file('image');
        $fileName = uniqid() . '.' . $image->getClientOriginalExtension();

        // Store original file
        Storage::disk('minio')->putFileAs('uploads', $image, $fileName);

        // Create thumbnail using Intervention
        $thumbnail = Image::make($image->getRealPath())->fit(200, 200);
        $thumbnailPath = 'thumbnails/' . $fileName;
        Storage::disk('minio')->put($thumbnailPath, (string) $thumbnail->encode());

        // Generate temporary signed URL (valid for 10 minutes)
        $url = Storage::disk('minio')->temporaryUrl(
            $thumbnailPath,
            now()->addMinutes(10)
        );

        return response()->json([
            'thumbnail_url' => $url
        ]);
    }
} -->
