<?php

namespace App\Http\Controllers\Admin;

use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogCategoryController extends ResourceController
{
    protected string $model = BlogCategory::class;
    protected string $viewPrefix = 'admin.blog-categories';
    protected string $routePrefix = 'admin.blog-categories';

    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255'
        ];
    }

    protected function searchable(): ?string
    {
        return 'name';
    }

}