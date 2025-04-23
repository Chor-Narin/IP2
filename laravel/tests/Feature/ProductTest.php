<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_if_product_fetch_successful(): void
    {
        $response = $this->get('/api/products');

        $response->assertStatus(200);
    }
}
