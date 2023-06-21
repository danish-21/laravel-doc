<?php

namespace Tests\Unit;

use App\Http\Controllers\UserController;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    /**
     * A basic test example.
     */
    public function test_that_true_is_true(): void
    {
        $this->assertTrue(true);
    }

}
