<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAuthTest extends TestCase
{
    public function test_login_page_renders(): void
    {
        $this->get('/admin/login')->assertStatus(200);
    }

    public function test_authenticated_user_can_access_dashboard(): void
    {
        $user = User::where('email', 'amiribajuun992@gmail.com')->first()
            ?? User::factory()->create(['password' => bcrypt('password')]);

        $this->actingAs($user)
            ->get('/admin/dashboard')
            ->assertStatus(200);
    }

    public function test_guest_is_redirected_to_login(): void
    {
        $this->get('/admin/dashboard')
            ->assertRedirect('/admin/login');
    }

    public function test_login_with_valid_credentials(): void
    {
        User::updateOrCreate(
            ['email' => 'amiribajuun992@gmail.com'],
            ['name' => 'Amiri Bajuun', 'password' => bcrypt('password')]
        );

        $this->post('/admin/login', [
            'email' => 'amiribajuun992@gmail.com',
            'password' => 'password',
        ])->assertRedirect('/admin/dashboard');
    }

    public function test_login_with_invalid_credentials_shows_error(): void
    {
        $this->post('/admin/login', [
            'email' => 'amiribajuun992@gmail.com',
            'password' => 'wrong-password',
        ])->assertSessionHasErrors('email');
    }

    public function test_logout_redirects_to_login(): void
    {
        $user = User::where('email', 'amiribajuun992@gmail.com')->firstOrFail();

        $this->actingAs($user)
            ->post('/admin/logout')
            ->assertRedirect('/admin/login');
    }
}