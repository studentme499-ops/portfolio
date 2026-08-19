<?php

namespace App\Http\Controllers\Admin;

use App\Models\SocialLink;
use Illuminate\Http\Request;

class SocialLinkController extends ResourceController
{
    protected string $model = SocialLink::class;
    protected string $viewPrefix = 'admin.social-links';
    protected string $routePrefix = 'admin.social-links';

    protected function rules(): array
    {
        return [
            'platform' => 'required|string|max:255',
            'icon' => 'nullable|string',
            'url' => 'required|url',
            'username' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean'
        ];
    }

    protected function searchable(): ?string
    {
        return 'name';
    }

}