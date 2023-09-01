<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic unit test example.
     */

    public function testCreateProductWithMiddleware()
    {
        $data = [
            'name' => "New Product",
            'description' => "This is a product",
            'category_id' => 1,
            'price' => 10,
            'file_id' => 1, // Replace with a valid file ID
        ];

        // Send a POST request to the bulkCreate endpoint without authentication
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/products/bulkCreate', ['products' => [$data]]);

        // Assert that the response matches the expectations
        $response->assertStatus(401);
        $response->assertJson(['message' => "Unauthenticated."]);
    }

}
