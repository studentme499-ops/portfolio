<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResumeController extends Controller
{
    public function index()
    {
        return view('admin.resume.index', [
            'items' => Resume::orderByDesc('is_active')->latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf|max:10240',
            'version' => 'nullable|string|max:50',
        ]);

        $file = $request->file('file');
        $version = $request->version ?: 'v'.Resume::count() + 1;

        $path = $file->store('resumes', 'public');

        Resume::where('is_active', true)->update(['is_active' => false]);

        Resume::create([
            'filename' => $file->getClientOriginalName(),
            'path' => $path,
            'size' => round($file->getSize() / 1024, 1).' KB',
            'version' => $version,
            'is_active' => true,
        ]);

        return redirect()->route('admin.resume.index')->with('status', 'CV uploaded and set active.');
    }

    public function setActive(Resume $resume)
    {
        Resume::where('id', '!=', $resume->id)->update(['is_active' => false]);
        $resume->update(['is_active' => true]);

        return back()->with('status', 'CV activated.');
    }

    public function download(Resume $resume)
    {
        return Storage::disk('public')->download($resume->path, $resume->filename);
    }

    public function destroy(Resume $resume)
    {
        Storage::disk('public')->delete($resume->path);
        $resume->delete();

        return back()->with('status', 'CV deleted.');
    }
}