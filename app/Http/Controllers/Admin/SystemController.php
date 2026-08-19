<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class SystemController extends Controller
{
    public function index()
    {
        $db = config('database.connections.mysql');

        $info = [
            'Laravel Version' => app()->version(),
            'PHP Version' => phpversion(),
            'MySQL Version' => \Illuminate\Support\Facades\DB::select('SELECT VERSION() as v')[0]->v ?? '—',
            'Server OS' => php_uname('s').' '.php_uname('r'),
            'Server IP' => request()->server('SERVER_ADDR') ?: '127.0.0.1',
            'Memory Limit' => ini_get('memory_limit'),
            'Storage Used' => $this->dirSize(storage_path()),
            'Disk Usage' => $this->formatBytes((int) disk_free_space(base_path())),
            'Environment' => app()->environment(),
            'Debug Mode' => config('app.debug') ? 'On' : 'Off',
            'Timezone' => config('app.timezone'),
            'URL' => config('app.url'),
        ];

        return view('admin.system', ['info' => $info]);
    }

    private function dirSize(string $path): string
    {
        $size = 0;
        $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path, \FilesystemIterator::SKIP_DOTS));

        foreach ($iterator as $file) {
            $size += $file->getSize();
        }

        return $this->formatBytes($size);
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