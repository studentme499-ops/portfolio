<?php

namespace App\Http\Controllers\Admin;

use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogController extends ResourceController
{
    protected string $model = BlogPost::class;
    protected string $viewPrefix = 'admin.blog';
    protected string $routePrefix = 'admin.blog';

    protected function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'nullable|string',
            'category_id' => 'nullable|exists:blog_categories,id',
            'tags' => 'nullable|array',
            'author' => 'nullable|string',
            'publish_date' => 'nullable|date',
            'seo_title' => 'nullable|string',
            'seo_description' => 'nullable|string',
            'status' => 'required|in:draft,published,scheduled,archived'
        ];
    }

    protected function searchable(): ?string
    {
        return 'title';
    }

    protected function prepareData(Request $request, array $validated): array
    {
        $validated['tags'] = $request->has('tags') && is_array($request->tags)
            ? array_values(array_filter($request->tags))
            : null;
        if (empty($validated['slug'])) {
            $validated['slug'] = \Illuminate\Support\Str::slug($validated['title']);
        }

        return $validated;
    }
}