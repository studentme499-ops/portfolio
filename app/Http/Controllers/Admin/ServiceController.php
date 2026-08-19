<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends ResourceController
{
    protected string $model = Service::class;
    protected string $viewPrefix = 'admin.services';
    protected string $routePrefix = 'admin.services';

    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'icon' => 'nullable|string',
            'short_description' => 'nullable|string',
            'full_description' => 'nullable|string',
            'features' => 'nullable|array',
            'price' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean'
        ];
    }

    protected function searchable(): ?string
    {
        return 'name';
    }

    protected function prepareData(Request $request, array $validated): array
    {
        $validated['features'] = $request->has('features') && is_array($request->features)
            ? array_values(array_filter($request->features))
            : null;

        if (empty($validated['slug'])) {
            $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);
        }

        return $validated;
    }
}