<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create 20 parent categories
        $parentCategories = Category::factory()->count(20)->create();

        // Create 100 child categories for each parent category
        $parentCategories->each(function ($parentCategory) {
            Category::factory()->count(100)->create([
                'parent_id' => $parentCategory->id,
            ]);
        });
    }
}
