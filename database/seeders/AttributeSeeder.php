<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    public function run(): void
    {
        $attributes = [
            ['name' => 'Color', 'type' => 1, 'unit' => '', 'status' => 1],
            ['name' => 'Material', 'type' => 1, 'unit' => '', 'status' => 1],
            ['name' => 'Size', 'type' => 1, 'unit' => '', 'status' => 1],
            ['name' => 'Weight', 'type' => 2, 'unit' => 'kg', 'status' => 1],
            ['name' => 'Width', 'type' => 2, 'unit' => 'cm', 'status' => 1],
            ['name' => 'Height', 'type' => 2, 'unit' => 'cm', 'status' => 1],
            ['name' => 'Depth', 'type' => 2, 'unit' => 'cm', 'status' => 1],
        ];

        foreach ($attributes as $attribute) {
            Attribute::create($attribute);
        }
    }
}
