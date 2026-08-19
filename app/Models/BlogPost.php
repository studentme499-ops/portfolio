<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'featured_image', 'excerpt', 'content', 'category_id',
        'tags', 'author', 'publish_date', 'seo_title', 'seo_description', 'status',
    ];

    protected function casts(): array
    {
        return [
            'tags' => 'array',
            'publish_date' => 'datetime',
        ];
    }

    public function category()
    {
        return $this->belongsTo(BlogCategory::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}