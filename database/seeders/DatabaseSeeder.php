<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\VariantAttributeValue;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call([
            CategorySeeder::class,
            AttributeSeeder::class,
            AttributeValueSeeder::class,
            ProductSeeder::class,
            ProductVariantSeeder::class,
            VariantAttributeValueSeeder::class,
            MediaSeeder::class,
        ]);
    }
}
