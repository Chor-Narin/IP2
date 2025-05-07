<?php namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_all_categories()
    {
        Category::factory()->count(3)->create();

        $response = $this->getJson('/api/categories');
        // dump($response->json()); // <--- See actual response here
        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    public function test_can_create_category()
    {
        $data = ['name' => 'Electronics'];

        $response = $this->postJson('/api/categories', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment(['name' => 'Electronics']);

        $this->assertDatabaseHas('categories', $data);
    }

    public function test_create_category_validation_error()
    {
        $response = $this->postJson('/api/categories', ['name' => '']);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors('name');
    }

    public function test_can_get_single_category()
    {
        $category = Category::factory()->create(['name' => 'Test Category']);

        $response = $this->getJson("/api/categories/{$category->id}");
        // dump($response->json()); // <--- See actual response here
        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'Test Category']);
    }

    public function test_get_nonexistent_category_returns_404()
    {
        $response = $this->getJson('/api/categories/9999');

        $response->assertStatus(404);
    }

    public function test_can_update_category()
    {
        $category = Category::factory()->create(['name' => 'Old Name']);

        $response = $this->patchJson("/api/categories/{$category->id}", ['name' => 'Updated Name']);

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'Updated Name']);

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => 'Updated Name',
        ]);
    }

    public function test_update_category_validation_error()
    {
        $category = Category::factory()->create(['name' => 'Valid']);

        $response = $this->patchJson("/api/categories/{$category->id}", ['name' => '']);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors('name');
    }

    public function test_update_nonexistent_category_returns_404()
    {
        $response = $this->patchJson('/api/categories/9999', ['name' => 'New Name']);

        $response->assertStatus(404);
    }

    public function test_can_delete_category()
    {
        $category = Category::factory()->create();

        $response = $this->deleteJson("/api/categories/{$category->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['message' => 'Delete successful!']); // Adjusted to match the actual response message of the controller

        $this->assertSoftDeleted('categories', ['id' => $category->id]);
    }

    public function test_delete_nonexistent_category_returns_404()
    {
        $response = $this->deleteJson('/api/categories/9999');

        $response->assertStatus(404);
    }
}
