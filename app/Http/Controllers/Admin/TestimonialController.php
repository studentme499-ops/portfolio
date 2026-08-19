<?php

namespace App\Http\Controllers\Admin;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends ResourceController
{
    protected string $model = Testimonial::class;
    protected string $viewPrefix = 'admin.testimonials';
    protected string $routePrefix = 'admin.testimonials';

    protected function rules(): array
    {
        return [
            'client_name' => 'required|string|max:255',
            'position' => 'nullable|string',
            'company' => 'nullable|string',
            'testimonial' => 'required|string',
            'rating' => 'nullable|integer|between:1,5',
            'project' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean'
        ];
    }

    protected function searchable(): ?string
    {
        return 'name';
    }

}