<?php

namespace App\Http\Controllers\Admin;

use App\Models\Technology;
use Illuminate\Http\Request;

class TechnologyController extends ResourceController
{
    protected string $model = Technology::class;
    protected string $viewPrefix = 'admin.technologies';
    protected string $routePrefix = 'admin.technologies';

    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'icon' => 'nullable|string',
            'color' => 'nullable|string',
            'experience_level' => 'nullable|string',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean'
        ];
    }

    protected function searchable(): ?string
    {
        return 'name';
    }

}