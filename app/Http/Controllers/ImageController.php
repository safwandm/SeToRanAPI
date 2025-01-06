<?php

namespace App\Http\Controllers;

use App\Models\ImageData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'image' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $file = $request->file('image');
        $id_gambar = ImageData::storeImage($file);

        // Return the ID of the newly created image
        return response()->json(['id' => $id_gambar], 201);
    }

    public function show(Request $request)
    {
        // Find the image by ID or return a 404 error
        $imageData = ImageData::findOrFail($request->route("id"));

        // Return the image binary data with appropriate headers
        return response($imageData->data, 200)->header('Content-Type', 'image/jpeg');
    }
}
