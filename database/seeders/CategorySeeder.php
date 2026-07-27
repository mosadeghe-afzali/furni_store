<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'اتاق نشیمن', 'slug' => 'living-room', 'status' => 1],
            ['name' => 'اتاق خواب', 'slug' => 'bedroom', 'status' => 1],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        $subcategories = [
            ['name' => 'مبل', 'slug' => 'sofas', 'parent_id' => 1, 'status' => 1],
            ['name' => 'میز جلو مبلی', 'slug' => 'coffee-tables', 'parent_id' => 1, 'status' => 1],
            ['name' => 'تلویزیون', 'slug' => 'tv-stands', 'parent_id' => 1, 'status' => 1],
            ['name' => 'تخت خواب', 'slug' => 'beds', 'parent_id' => 2, 'status' => 1],
            ['name' => 'کمد لباس', 'slug' => 'wardrobes', 'parent_id' => 2, 'status' => 1],
        ];

        foreach ($subcategories as $subcategory) {
            Category::create($subcategory);
        }
    }
}
