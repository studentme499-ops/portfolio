<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NavigationItem extends Model
{
    use HasFactory;

    protected $fillable = ['label', 'url', 'is_external', 'sort_order', 'is_active'];

    protected function casts(): array
    {
        return [
            'is_external' => 'boolean',
            'is_active' => 'boolean',
        ];
    }
}