<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        // Get the value of 'justActives' from the request, default to false if not present
        $justActives = $request->input('justActives', false);

        // Build the query
        $query = Video::query();

        // Apply the filter if 'justActives' is true
        if ($justActives) {
            $query->where('active', true);
        }

        // Execute the query and get the results
        $videos = $query->orderByDesc('id')->get();

        // Return the results as a JSON response
        return response()->json($videos);
    }

    public function store(Request $request)
    {
        $request->validate([
            'video' => 'required|mimes:mp4,mov,avi,wmv|max:20480',
        ]);

        if ($request->file('video')) {
            $file = $request->file('video');
            $path = $file->store('videos', 'public');

            // Salvar o caminho do vídeo no banco de dados
            $video = new Video();
            $video->filename = $file->getClientOriginalName();
            $video->path = $path;
            $video->active = $request->has('active');
            $video->save();
        }

        return response()->json(['message' => 'Vídeo carregado com sucesso!', 'video' => $video], 201);
    }

    public function show($id)
    {
        $video = Video::find($id);

        if ($video) {
            return response()->json($video);
        }

        return response()->json(['message' => 'Video not found'], 404);
    }

    public function update(Request $request, $id)
    {
        $video = Video::find($id);

        if (!$video) {
            return response()->json(['message' => 'Video not found'], 404);
        }
        
        $request->validate([
            'video' => 'mimes:mp4,mov,avi,wmv|max:20480',
            'active' => 'boolean',
        ]);

        if ($request->hasFile('video')) {
            Storage::disk('public')->delete($video->path);

            $newVideo = $request->file('video');
            $path = $newVideo->store('videos', 'public');

            $video->path = $path;
        }

        if ($request->has('active')) {
            $video->active = $request->active;
        }

        $video->save();

        return response()->json($video);
    }

    public function destroy($id)
    {
        $video = Video::find($id);

        if ($video) {
            Storage::disk('public')->delete($video->path);
            $video->delete();
            return response()->json(['message' => 'Video deleted']);
        }

        return response()->json(['message' => 'Video not found'], 404);
    }
}
