<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Medium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $items = Medium::query()
            ->when($request->collection, fn ($q) => $q->where('collection', $request->collection))
            ->when($request->q, fn ($q) => $q->where('filename', 'like', "%{$request->q}%"))
            ->latest()
            ->paginate(30)
            ->withQueryString();

        return view('admin.media.index', [
            'items' => $items,
            'collections' => Medium::select('collection')->distinct()->pluck('collection'),
        ]);
    }

    public function create()
    {
        return view('admin.media.upload');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,gif,webp,svg,pdf,doc,docx,zip|max:10240',
            'collection' => 'nullable|string',
        ]);

        $file = $request->file('file');
        $collection = $request->collection ?: 'general';
        $safeDir = 'media/'.Str::slug($collection);

        $path = $file->store($safeDir, 'public');

        $medium = Medium::create([
            'filename' => $file->getClientOriginalName(),
            'path' => $path,
            'mime_type' => $file->getMimeType(),
            'size' => $this->formatBytes($file->getSize()),
            'collection' => $collection,
        ]);

        return redirect()->route('admin.media.index', ['collection' => $collection])
            ->with('status', 'File uploaded successfully.');
    }

    public function destroy(Medium $medium)
    {
        Storage::disk('public')->delete($medium->path);
        $medium->delete();

        return back()->with('status', 'File deleted.');
    }

    public function copyUrl(Medium $medium)
    {
        return response()->json(['url' => asset('storage/'.$medium->path)]);
    }

    private function formatBytes(int $bytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $i = 0;
        while ($bytes >= 1024 && $i < count($units) - 1) {
            $bytes /= 1024;
            $i++;
        }

        return round($bytes, 1).' '.$units[$i];
    }
}