<?php

namespace App\Http\Controllers\Admin;

use App\Models\NavigationItem;
use Illuminate\Http\Request;

class NavigationController extends ResourceController
{
    protected string $model = NavigationItem::class;
    protected string $viewPrefix = 'admin.navigation';
    protected string $routePrefix = 'admin.navigation';

    protected function rules(): array
    {
        return [
            'label' => 'required|string|max:255',
            'url' => 'required|string',
            'is_external' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean'
        ];
    }

    protected function searchable(): ?string
    {
        return 'name';
    }

}