<?php

namespace App\Http\Controllers\Admin;

use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends ResourceController
{
    protected string $model = Education::class;
    protected string $viewPrefix = 'admin.education';
    protected string $routePrefix = 'admin.education';

    protected function rules(): array
    {
        return [
            'institution' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'field' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
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