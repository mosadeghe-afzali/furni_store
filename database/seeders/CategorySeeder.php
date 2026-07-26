<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Living Room', 'slug' => 'living-room', 'status' => 1],
            ['name' => 'Bedroom', 'slug' => 'bedroom', 'status' => 1],
            ['name' => 'Office', 'slug' => 'office', 'status' => 1],
            ['name' => 'Outdoor', 'slug' => 'outdoor', 'status' => 1],
            ['name' => 'Dining', 'slug' => 'dining', 'status' => 1],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        $subcategories = [
            ['name' => 'Sofas', 'slug' => 'sofas', 'parent_id' => 1, 'status' => 1],
            ['name' => 'Coffee Tables', 'slug' => 'coffee-tables', 'parent_id' => 1, 'status' => 1],
            ['name' => 'TV Stands', 'slug' => 'tv-stands', 'parent_id' => 1, 'status' => 1],
            ['name' => 'Beds', 'slug' => 'beds', 'parent_id' => 2, 'status' => 1],
            ['name' => 'Wardrobes', 'slug' => 'wardrobes', 'parent_id' => 2, 'status' => 1],
            ['name' => 'Nightstands', 'slug' => 'nightstands', 'parent_id' => 2, 'status' => 1],
            ['name' => 'Desks', 'slug' => 'desks', 'parent_id' => 3, 'status' => 1],
            ['name' => 'Office Chairs', 'slug' => 'office-chairs', 'parent_id' => 3, 'status' => 1],
            ['name' => 'Bookcases', 'slug' => 'bookcases', 'parent_id' => 3, 'status' => 1],
            ['name' => 'Patio Sets', 'slug' => 'patio-sets', 'parent_id' => 4, 'status' => 1],
            ['name' => 'Dining Tables', 'slug' => 'dining-tables', 'parent_id' => 5, 'status' => 1],
            ['name' => 'Dining Chairs', 'slug' => 'dining-chairs', 'parent_id' => 5, 'status' => 1],
        ];

        foreach ($subcategories as $subcategory) {
            Category::create($subcategory);
        }
    }
}
