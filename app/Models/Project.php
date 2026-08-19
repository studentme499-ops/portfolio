<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'category', 'year', 'short_description', 'full_description',
        'featured_image', 'gallery', 'technologies', 'client', 'project_url',
        'github_url', 'demo_url', 'status', 'is_featured', 'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'gallery' => 'array',
            'technologies' => 'array',
            'is_featured' => 'boolean',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}