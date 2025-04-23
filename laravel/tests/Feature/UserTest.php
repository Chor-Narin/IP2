<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_all_users()
    {
        $users = User::factory()->count(3)->create();

        $response = $this->getJson('/api/users');

        $response->assertStatus(200)
            ->assertJsonCount(3)
            ->assertJson($users->toArray());
    }

    public function test_can_create_user()
    {
        $userData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
        ];

        $response = $this->postJson('/api/users', $userData);

        $response->assertStatus(201)
            ->assertJson([
                'name' => 'John Doe',
                'email' => 'john@example.com'
            ]);

        $this->assertDatabaseHas('users', ['email' => 'john@example.com']);
        $this->assertTrue(Hash::check('password123', User::first()->password));
    }

    public function test_can_get_single_user()
    {
        $user = User::factory()->create();

        $response = $this->getJson("/api/users/{$user->id}");

        $response->assertStatus(200)
            ->assertJson($user->toArray());
    }

    public function test_can_update_user()
    {
        $user = User::factory()->create();

        $updateData = [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'password' => 'newpassword123'
        ];

        $response = $this->putJson("/api/users/{$user->id}", $updateData);

        $response->assertStatus(200)
            ->assertJson($updateData);

        $this->assertTrue(Hash::check('newpassword123', $user->fresh()->password));
    }

    public function test_can_delete_user()
    {
        $user = User::factory()->create();

        $response = $this->deleteJson("/api/users/{$user->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    public function test_create_user_validation()
    {
        $response = $this->postJson('/api/users', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'email', 'password']);
    }

    public function test_update_email_validation()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $response = $this->putJson("/api/users/{$user1->id}", [
            'email' => $user2->email
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }
}