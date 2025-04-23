<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Category; // Import model
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    use RefreshDatabase; // Clears database before each test

    public function test_if_fetch_all_categories_success()
    {
        // Create test data
        // Category::factory()->count(3)->create();

        // Call the API
        $response = $this->get('/api/categories');

        // Assert response
        $response->assertStatus(200);
    }

    public function test_if_create_category_successful()
    {
        $response = $this->post('/api/categories', [
            'name' => 'Test Category'
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('categories', ['name' => 'Test Category']);
    }
}
