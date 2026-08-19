<?php

namespace App\Http\Controllers\Admin;

use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends ResourceController
{
    protected string $model = Experience::class;
    protected string $viewPrefix = 'admin.experience';
    protected string $routePrefix = 'admin.experience';

    protected function rules(): array
    {
        return [
            'company' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'employment_type' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'is_current' => 'nullable|boolean',
            'location' => 'nullable|string',
            'description' => 'nullable|string',
            'responsibilities' => 'nullable|array',
            'technologies' => 'nullable|array',
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
        foreach (['responsibilities', 'technologies'] as $f) {
            $validated[$f] = $request->has($f) && is_array($request->{$f})
                ? array_values(array_filter($request->{$f}))
                : null;
        }
        $validated['is_current'] = $request->boolean('is_current');

        return $validated;
    }
}