<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_login_and_be_redirected_to_the_admin_dashboard()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create([
            'email' => 'sajnushhossain.cse@gmail.com',
            'password' => Hash::make('sajnush'),
        ]);

        $response = $this->post('/login', [
            'email' => 'sajnushhossain.cse@gmail.com',
            'password' => 'sajnush',
        ]);

        $response->assertRedirect('/admin');
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function an_unauthenticated_user_cannot_login_with_invalid_credentials()
    {
        $user = User::factory()->create([
            'password' => Hash::make('sajnush'),
        ]);

        $response = $this->post('/login', [
            'email' => 'sajnushhossain.cse@gmail.com',
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors();
        $this->assertGuest();
    }

    /** @test */
    public function a_logged_in_user_can_be_logged_out()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/logout');

        $response->assertRedirect('/');
        $this->assertGuest();
    }
}
