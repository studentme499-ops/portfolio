<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Backup;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BackupController extends Controller
{
    public function index()
    {
        return view('admin.backups.index', [
            'items' => Backup::latest()->get(),
        ]);
    }

    public function create()
    {
        $type = request('type', 'database');

        $name = 'backup-'.Str::slug($type).'-'.now()->format('Y-m-d-His');
        $filename = $name.'.sql';

        if ($type === 'database') {
            $db = config('database.connections.mysql.database');
            $user = config('database.connections.mysql.username');
            $pass = config('database.connections.mysql.password');
            $host = config('database.connections.mysql.host');

            $command = "mysqldump -h {$host} -u {$user} -p{$pass} {$db}";
            exec($command, $output, $code);

            if ($code !== 0 || empty($output)) {
                return back()->withErrors(['type' => 'Database backup failed. Is mysqldump available?']);
            }

            $path = 'backups/'.$filename;
            Storage::disk('local')->put($path, implode("\n", $output));

            Backup::create([
                'name' => $name,
                'path' => $path,
                'size' => $this->formatBytes(strlen(implode("\n", $output))),
                'type' => 'database',
            ]);

            return redirect()->route('admin.backups.index')->with('status', 'Database backup created.');
        }

        return back()->with('status', 'Only database backups are supported in this environment.');
    }

    public function download(Backup $backup)
    {
        return Storage::disk('local')->download($backup->path, $backup->name.'.sql');
    }

    public function destroy(Backup $backup)
    {
        Storage::disk('local')->delete($backup->path);
        $backup->delete();

        return back()->with('status', 'Backup deleted.');
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