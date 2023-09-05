<?php

namespace Database\Factories;

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
   /* public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'parent_id' => null, // This will be overridden for child categories
            'file_id' => null,   // You can modify this as needed
            'is_active' => $this->faker->boolean,
        ];
    }*/
    public function definition(): array
    {
        $mobileNames = ['Samsung', 'Apple', 'Google', 'Huawei', 'Xiaomi', 'OPPO'];

        return [
            'name' => $mobileNames[array_rand($mobileNames)],
            'parent_id' => null,
            'file_id' => null,
            'is_active' => $this->faker->boolean,
        ];
    }

    /**
     * Configure the factory to create child categories.
     *
     * @return $this
     */
    public function configure(): CategoryFactory
    {
        return $this->afterCreating(function (Category $category) {
            $childCount = $this->faker->numberBetween(1, 6);
            Category::factory()
                ->count($childCount)
                ->create([
                    'parent_id' => $category->id,
                ]);
        });
    }
}

