<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'Super Admin', 'slug' => 'super-admin', 'permissions' => ['*']],
            ['name' => 'Admin', 'slug' => 'admin', 'permissions' => ['*']],
            ['name' => 'Editor', 'slug' => 'editor', 'permissions' => [
                'projects.view', 'projects.create', 'projects.edit',
                'services.view', 'services.create', 'services.edit',
                'blog.view', 'blog.create', 'blog.edit',
                'messages.view', 'messages.reply',
                'technologies.view', 'technologies.edit',
            ]],
            ['name' => 'Developer', 'slug' => 'developer', 'permissions' => [
                'projects.view', 'services.view', 'blog.view',
                'technologies.view', 'settings.view',
            ]],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(['slug' => $role['slug']], $role);
        }

        $superAdmin = Role::where('slug', 'super-admin')->first();

        User::updateOrCreate(
            ['email' => 'amiribajuun992@gmail.com'],
            [
                'name' => 'Amiri Bajuun',
                'password' => Hash::make('password123'),
                'role_id' => $superAdmin->id,
                'is_active' => true,
            ]
        );
    }
}