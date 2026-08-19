<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends ResourceController
{
    protected string $model = Project::class;
    protected string $viewPrefix = 'admin.projects';
    protected string $routePrefix = 'admin.projects';

    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'category' => 'nullable|string',
            'year' => 'nullable|string',
            'short_description' => 'nullable|string',
            'full_description' => 'nullable|string',
            'featured_image' => 'nullable|string',
            'gallery' => 'nullable|array',
            'technologies' => 'nullable|array',
            'client' => 'nullable|string',
            'project_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'demo_url' => 'nullable|url',
            'status' => 'required|in:draft,published',
            'is_featured' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ];
    }

    public function create()
    {
        return view("$this->viewPrefix.form", [
            'item' => null,
            'resource' => $this->resourceName(),
            'technologies' => Technology::orderBy('name')->get(),
        ]);
    }

    public function edit($id)
    {
        return view("$this->viewPrefix.form", [
            'item' => $this->model::findOrFail($id),
            'resource' => $this->resourceName(),
            'technologies' => Technology::orderBy('name')->get(),
        ]);
    }

    protected function prepareData(Request $request, array $validated): array
    {
        $validated['slug'] = ! empty($validated['slug'])
            ? Str::slug($validated['slug'])
            : Str::slug($validated['name']);

        $validated['gallery'] = $request->has('gallery') && is_array($request->gallery)
            ? array_values(array_filter($request->gallery))
            : null;

        $validated['technologies'] = $request->has('technologies') && is_array($request->technologies)
            ? array_values($request->technologies)
            : null;

        $validated['is_featured'] = $request->boolean('is_featured');

        return $validated;
    }

    protected function searchable(): ?string
    {
        return 'name';
    }
}
