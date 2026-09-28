<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5120', // 5MB max
        ]);

        if ($request->hasFile('image')) {
            // Save file to storage/app/public/uploads
            $path = $request->file('image')->store('uploads', 'public');

            return response()->json([
                'status'    => 'success',
                'file_path' => $path,
                'file_url'  => asset('storage/' . $path),
            ], 200);
        }

        return response()->json(['error' => 'No image uploaded'], 400);
    }
}