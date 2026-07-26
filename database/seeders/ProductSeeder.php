<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Living Room - Sofas (category_id: 6)
            [
                'category_id' => 6,
                'name' => 'Modern L-Shape Sofa',
                'slug' => 'modern-l-shape-sofa',
                'description' => 'Spacious L-shaped sofa with premium fabric upholstery and solid wood frame.',
                'status' => 1,
            ],
            [
                'category_id' => 6,
                'name' => 'Classic Chesterfield Sofa',
                'slug' => 'classic-chevronfield-sofa',
                'description' => 'Elegant Chesterfield sofa with deep button tufting and rolled arms.',
                'status' => 1,
            ],
            // Living Room - Coffee Tables (category_id: 7)
            [
                'category_id' => 7,
                'name' => 'Marble Top Coffee Table',
                'slug' => 'marble-top-coffee-table',
                'description' => 'Luxurious coffee table with genuine marble top and gold metal legs.',
                'status' => 1,
            ],
            [
                'category_id' => 7,
                'name' => 'Rustic Wooden Coffee Table',
                'slug' => 'rustic-wooden-coffee-table',
                'description' => 'Solid acacia wood coffee table with natural grain finish.',
                'status' => 1,
            ],
            // Bedroom - Beds (category_id: 9)
            [
                'category_id' => 9,
                'name' => 'Platform Bed Queen',
                'slug' => 'platform-bed-queen',
                'description' => 'Minimalist platform bed with built-in headboard and under-bed storage.',
                'status' => 1,
            ],
            [
                'category_id' => 9,
                'name' => 'Upholstered King Bed',
                'slug' => 'upholstered-king-bed',
                'description' => 'Luxurious king bed with velvet upholstered frame and tufted headboard.',
                'status' => 1,
            ],
            // Bedroom - Nightstands (category_id: 11)
            [
                'category_id' => 11,
                'name' => '2-Drawer Nightstand',
                'slug' => '2-drawer-nightstand',
                'description' => 'Compact nightstand with two soft-close drawers and open shelf.',
                'status' => 1,
            ],
            // Office - Desks (category_id: 12)
            [
                'category_id' => 12,
                'name' => 'Standing Desk Electric',
                'slug' => 'standing-desk-electric',
                'description' => 'Height-adjustable electric standing desk with memory presets.',
                'status' => 1,
            ],
            [
                'category_id' => 12,
                'name' => 'Executive Office Desk',
                'slug' => 'executive-office-desk',
                'description' => 'Spacious executive desk with built-in cable management and drawers.',
                'status' => 1,
            ],
            // Office - Office Chairs (category_id: 13)
            [
                'category_id' => 13,
                'name' => 'Ergonomic Mesh Chair',
                'slug' => 'ergonomic-mesh-chair',
                'description' => 'Fully adjustable ergonomic chair with lumbar support and mesh back.',
                'status' => 1,
            ],
            // Dining - Dining Tables (category_id: 16)
            [
                'category_id' => 16,
                'name' => 'Extendable Dining Table',
                'slug' => 'extendable-dining-table',
                'description' => 'Solid oak dining table that extends from 6 to 10 seats.',
                'status' => 1,
            ],
            // Dining - Dining Chairs (category_id => 17)
            [
                'category_id' => 17,
                'name' => 'Leather Dining Chair',
                'slug' => 'leather-dining-chair',
                'description' => 'Modern dining chair with genuine leather seat and metal legs.',
                'status' => 1,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
