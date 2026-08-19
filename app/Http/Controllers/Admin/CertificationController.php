<?php

namespace App\Http\Controllers\Admin;

use App\Models\Certification;
use Illuminate\Http\Request;

class CertificationController extends ResourceController
{
    protected string $model = Certification::class;
    protected string $viewPrefix = 'admin.certifications';
    protected string $routePrefix = 'admin.certifications';

    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'organization' => 'required|string|max:255',
            'issue_date' => 'nullable|date',
            'expiry_date' => 'nullable|date',
            'credential_id' => 'nullable|string',
            'credential_url' => 'nullable|url',
            'is_active' => 'nullable|boolean'
        ];
    }

    protected function searchable(): ?string
    {
        return 'name';
    }

}