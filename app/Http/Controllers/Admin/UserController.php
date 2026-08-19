<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends ResourceController
{
    protected string $model = User::class;
    protected string $viewPrefix = 'admin.users';
    protected string $routePrefix = 'admin.users';

    public function create()
    {
        return view('admin.users.form', [
            'item' => null,
            'resource' => $this->resourceName(),
            'roles' => Role::orderBy('name')->get(),
        ]);
    }

    public function edit($id)
    {
        $item = $this->model::findOrFail($id);

        return view('admin.users.form', [
            'item' => $item,
            'resource' => $this->resourceName(),
            'roles' => Role::orderBy('name')->get(),
        ]);
    }

    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:8',
            'role_id' => 'nullable|exists:roles,id',
            'is_active' => 'nullable|boolean'
        ];
    }

    protected function searchable(): ?string
    {
        return 'name';
    }

    protected function ordering(): ?string
    {
        return null;
    }

    protected function prepareData(Request $request, array $validated): array
    {
        if (!empty($validated['password'])) {
            $validated['password'] = \Illuminate\Support\Facades\Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }
        $validated['is_active'] = $request->boolean('is_active');

        return $validated;
    }
}