<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth; // Import the Auth facade


class ProductTest extends TestCase
{

    use RefreshDatabase; // Automatically migrate and refresh the test database

    public function testCreateProductWithMiddleware()
    {

        $data = [
            'name' => "New Product",
            'description' => "This is a product",
            'category_id' => 1,
            'price' => 10,
            'file_id' => 1,
        ];

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/products/bulkCreate', ['products' => [$data]]);

        // Assert that the response matches the expectations
        $response->assertStatus(401);
        $response->assertJson(['message' => "Unauthenticated."]);
    }

}
