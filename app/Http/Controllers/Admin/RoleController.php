<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends ResourceController
{
    protected string $model = Role::class;
    protected string $viewPrefix = 'admin.roles';
    protected string $routePrefix = 'admin.roles';

    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'permissions' => 'nullable|array'
        ];
    }

    protected function searchable(): ?string
    {
        return 'name';
    }

    protected function ordering(): ?string
    {
        return null;
    }

    protected function permissionList(): array
    {
        return [
            'Dashboard' => ['dashboard.view'],
            'Projects' => ['projects.view', 'projects.create', 'projects.edit', 'projects.delete'],
            'Services' => ['services.view', 'services.create', 'services.edit', 'services.delete'],
            'Blog' => ['blog.view', 'blog.create', 'blog.edit', 'blog.delete'],
            'Messages' => ['messages.view', 'messages.reply', 'messages.delete'],
            'Media' => ['media.view', 'media.upload', 'media.delete'],
            'Users' => ['users.view', 'users.create', 'users.edit', 'users.delete'],
            'Settings' => ['settings.view', 'settings.edit'],
            'Backups' => ['backups.view', 'backups.create', 'backups.delete'],
        ];
    }

    public function create()
    {
        return view('admin.roles.form', [
            'item' => null,
            'resource' => $this->resourceName(),
            'permissions' => $this->permissionList(),
        ]);
    }

    public function edit($id)
    {
        $item = $this->model::findOrFail($id);

        return view('admin.roles.form', [
            'item' => $item,
            'resource' => $this->resourceName(),
            'permissions' => $this->permissionList(),
        ]);
    }

    protected function prepareData(Request $request, array $validated): array
    {
        $validated['permissions'] = $request->permissions ?? [];
        if (empty($validated['slug'])) {
            $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);
        }

        return $validated;
    }
}