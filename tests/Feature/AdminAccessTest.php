<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_guest_cannot_access_admin_routes()
    {
        $this->get('/admin/posts')->assertRedirect('/login');
    }

    /** @test */
    public function a_user_with_user_role_cannot_access_admin_routes()
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->actingAs($user)->get('/admin/posts')->assertStatus(403);
    }

    /** @test */
    public function a_user_with_moderator_role_can_access_allowed_admin_routes()
    {
        $user = User::factory()->create(['role' => 'moderator']);
        $this->actingAs($user)->get('/admin/posts')->assertOk();
    }

    /** @test */
    public function a_user_with_admin_role_can_access_admin_routes()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $this->actingAs($user)->get('/admin/posts')->assertOk();
    }

    /** @test */
    public function a_user_with_sajnushhossain_email_can_access_admin_routes()
    {
        $user = User::factory()->create(['email' => 'sajnushhossain.cse@gmail.com']);
        $this->actingAs($user)->get('/admin/posts')->assertOk();
    }
}
