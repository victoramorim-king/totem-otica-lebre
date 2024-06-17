<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function index(Request $request, $tipo)
    {
        // Get the value of 'justActives' from the request, default to false if not present
        $justActives = $request->input('justActives', false);

        // Build the query
        $query = Image::where('category', $tipo);

        // Apply the filter if 'justActives' is true
        if ($justActives) {
            $query->where('active', true);
        }

        // Execute the query and get the results
        $images = $query->orderByDesc('id')->get();

        // Return the results as a JSON response
        return response()->json($images);
    }


    public function store(Request $request)
    {

        $image = $request->file('image');
        $path = $image->store('images', 'public');

        $newImage = new Image();
        $newImage->filename = $image->getClientOriginalName();
        $newImage->path = $path;
        $newImage->category = $request->category;
        $newImage->active = $request->has('active');
        $newImage->save();
        return response()->json(['message' => 'ok!'], 201);
    }

    public function show($id)
    {
        $image = Image::find($id);

        if ($image) {
            return response()->json($image);
        }

        return response()->json(['message' => 'Image not found'], 404);
    }


    public function update(Request $request, $id)
    {
        $image = Image::find($id);

        if (!$image) {
            return response()->json(['message' => 'Image not found'], 404);
        }

        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'string',
            'active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($image->path);

            $newImage = $request->file('image');
            $path = $newImage->store('images', 'public');

            $image->filename = $newImage->getClientOriginalName();
            $image->path = $path;
        }

        if ($request->has('category')) {
            $image->category = $request->category;
        }

        if ($request->has('active')) {
            $image->active = $request->active;
        }

        $image->save();

        return response()->json($image);
    }

    public function destroy($id)
    {
        $image = Image::find($id);

        if ($image) {
            Storage::disk('public')->delete($image->path);
            $image->delete();
            return response()->json(['message' => 'Image deleted']);
        }

        return response()->json(['message' => 'Image not found'], 404);
    }
}
