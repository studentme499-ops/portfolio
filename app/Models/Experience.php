<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'company', 'position', 'employment_type', 'start_date', 'end_date',
        'is_current', 'location', 'description', 'responsibilities',
        'technologies', 'company_logo', 'sort_order', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'is_current' => 'boolean',
            'responsibilities' => 'array',
            'technologies' => 'array',
            'is_active' => 'boolean',
        ];
    }
}