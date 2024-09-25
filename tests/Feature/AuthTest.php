<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AuthTest extends TestCase
{
    use DatabaseMigrations;

    public function test_user_successfully_get_token()
    {
        User::factory()->create();
        
        // Get token successful attempt
        $response = $this->postJson('/api/get_token', [
            'email' => 'test@mail.com',
            'password' => 'test',
        ]);
        $response->assertStatus(200)
                ->assertJson([
                    'success' => true,
                ])
                ->assertJsonStructure([
                    'token'
                ]);
                
        // Invalidate token
        $token = $response->json('token');
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
                         ->postJson('/api/invalidate_token');
        $response->assertStatus(200)
                ->assertJson([
                    'success' => true,
                ]);
    }

    public function test_user_failed_get_token_wrong_email()
    {
        User::factory()->create();

        $response = $this->postJson('/api/get_token', [
            'email' => 'wrong@mail.com',
            'password' => 'test',
        ]);
        $response->assertStatus(401)
                ->assertJson([
                    'success' => false,
                ]);
    }

    public function test_user_failed_get_token_wrong_password()
    {
        User::factory()->create();

        $response = $this->postJson('/api/get_token', [
            'email' => 'test@mail.com',
            'password' => 'wrong',
        ]);
        $response->assertStatus(401)
                ->assertJson([
                    'success' => false,
                ]);
    }
}
