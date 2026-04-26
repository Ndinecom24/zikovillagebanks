<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /* ══════════════════════════════════════
       Login
       ══════════════════════════════════════ */

    public function test_login_page_renders(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function test_user_can_login_with_email(): void
    {
        $user = User::factory()->create([
            'email'    => 'test@example.com',
            'password' => bcrypt('Password1!'),
            'status'   => 'active',
        ]);

        $response = $this->post('/login', [
            'login'    => 'test@example.com',
            'password' => 'Password1!',
        ]);

        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_can_login_with_username(): void
    {
        $user = User::factory()->create([
            'username' => 'johndoe',
            'password' => bcrypt('Password1!'),
            'status'   => 'active',
        ]);

        $response = $this->post('/login', [
            'login'    => 'johndoe',
            'password' => 'Password1!',
        ]);

        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);
    }

    public function test_login_fails_with_wrong_password(): void
    {
        User::factory()->create([
            'email'    => 'test@example.com',
            'password' => bcrypt('CorrectPass1!'),
        ]);

        $response = $this->post('/login', [
            'login'    => 'test@example.com',
            'password' => 'WrongPassword!',
        ]);

        $this->assertGuest();
    }

    public function test_login_requires_credentials(): void
    {
        $response = $this->post('/login', [
            'login'    => '',
            'password' => '',
        ]);

        $response->assertSessionHasErrors(['login']);
    }

    /* ══════════════════════════════════════
       Logout
       ══════════════════════════════════════ */

    public function test_authenticated_user_can_logout(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/logout');

        $this->assertGuest();
    }

    /* ══════════════════════════════════════
       Registration
       ══════════════════════════════════════ */

    public function test_register_page_renders(): void
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    public function test_user_can_register(): void
    {
        $response = $this->post('/register', [
            'username'              => 'newuser',
            'name'                  => 'New User',
            'email'                 => 'new@example.com',
            'password'              => 'StrongP@ss1',
            'password_confirmation' => 'StrongP@ss1',
        ]);

        $this->assertDatabaseHas('users', [
            'email'    => 'new@example.com',
            'username' => 'newuser',
        ]);
        $this->assertAuthenticated();
    }

    public function test_registration_validates_unique_email(): void
    {
        User::factory()->create(['email' => 'taken@example.com']);

        $response = $this->post('/register', [
            'username'              => 'someone',
            'name'                  => 'Someone',
            'email'                 => 'taken@example.com',
            'password'              => 'StrongP@ss1',
            'password_confirmation' => 'StrongP@ss1',
        ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_registration_validates_unique_username(): void
    {
        User::factory()->create(['username' => 'takenuser']);

        $response = $this->post('/register', [
            'username'              => 'takenuser',
            'name'                  => 'Someone',
            'email'                 => 'unique@example.com',
            'password'              => 'StrongP@ss1',
            'password_confirmation' => 'StrongP@ss1',
        ]);

        $response->assertSessionHasErrors('username');
    }

    /* ══════════════════════════════════════
       Protected Routes
       ══════════════════════════════════════ */

    public function test_guest_cannot_access_home(): void
    {
        $response = $this->get('/home');
        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_access_home(): void
    {
        // /home requires 'view-dashboard' permission — super-admin bypasses
        $user = User::factory()->superAdmin()->create();
        $this->actingAs($user);

        $response = $this->get('/home');
        $response->assertStatus(200);
    }

    public function test_authenticated_user_without_permission_gets_forbidden(): void
    {
        $user = User::factory()->create(); // regular user, no permissions
        $this->actingAs($user);

        $response = $this->get('/home');
        $response->assertStatus(403);
    }
}
