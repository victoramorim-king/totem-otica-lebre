<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function index()
    {
        // $videos = Video::all();
        $videos = [];

        $videos[] = [
            'path' => asset('videos/demo.mp4'),
            'active' => 'true',
        ];

        $videos[] = [
            'path' => asset('videos/demo2.mp4'),
            'active' => 'true',
        ];

        $videos[] = [
            'path' => asset('videos/demo3.mp4'),
            'active' => 'true',
        ];

        return response()->json($videos);
    }

    public function store(Request $request)
    {
        $request->validate([
            'video' => 'required|mimes:mp4,mov,avi,wmv|max:20480',
        ]);

        if ($request->file('video')) {
            $file = $request->file('video');
            $path = $file->store('videos', 'public'); // Armazenando na pasta 'videos' no disco 'public'
    
            // Salvar o caminho do vídeo no banco de dados
            $video = new Video();
            $video->path = $path;
            $video->active = $request->has('active') ? $request->active : true; // Padrão: ativo
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
