<?php

namespace Database\Seeders;

use App\Models\ProductVariant;
use Illuminate\Database\Seeder;

class ProductVariantSeeder extends Seeder
{
    public function run(): void
    {
        $variants = [
            // Modern L-Shape Sofa (product_id: 1)
            ['product_id' => 1, 'title' => 'Gray / Large', 'sku' => 'MLS-GRY-L', 'price' => 129900, 'inventory' => 15, 'status' => 1],
            ['product_id' => 1, 'title' => 'Navy Blue / Large', 'sku' => 'MLS-NBY-L', 'price' => 134900, 'inventory' => 10, 'status' => 1],
            ['product_id' => 1, 'title' => 'Beige / Medium', 'sku' => 'MLS-BEG-M', 'price' => 109900, 'inventory' => 20, 'status' => 1],

            // Classic Chesterfield Sofa (product_id: 2)
            ['product_id' => 2, 'title' => 'Brown Leather', 'sku' => 'CCS-BRN-L', 'price' => 189900, 'inventory' => 8, 'status' => 1],
            ['product_id' => 2, 'title' => 'Black Leather', 'sku' => 'CCS-BLK-L', 'price' => 189900, 'inventory' => 5, 'status' => 1],

            // Marble Top Coffee Table (product_id: 3)
            ['product_id' => 3, 'title' => 'White Marble / Gold', 'sku' => 'MCT-WMG-M', 'price' => 49900, 'inventory' => 25, 'status' => 1],
            ['product_id' => 3, 'title' => 'Black Marble / Gold', 'sku' => 'MCT-BKG-M', 'price' => 52900, 'inventory' => 18, 'status' => 1],

            // Rustic Wooden Coffee Table (product_id: 4)
            ['product_id' => 4, 'title' => 'Natural Finish', 'sku' => 'RWT-NAT-M', 'price' => 34900, 'inventory' => 30, 'status' => 1],
            ['product_id' => 4, 'title' => 'Dark Walnut', 'sku' => 'RWT-DWK-M', 'price' => 36900, 'inventory' => 22, 'status' => 1],

            // Platform Bed Queen (product_id: 5)
            ['product_id' => 5, 'title' => 'White Oak', 'sku' => 'PBQ-WHO-Q', 'price' => 89900, 'inventory' => 12, 'status' => 1],
            ['product_id' => 5, 'title' => 'Black Ash', 'sku' => 'PBQ-BKA-Q', 'price' => 89900, 'inventory' => 10, 'status' => 1],

            // Upholstered King Bed (product_id: 6)
            ['product_id' => 6, 'title' => 'Velvet Green / King', 'sku' => 'UKB-VGR-K', 'price' => 159900, 'inventory' => 6, 'status' => 1],
            ['product_id' => 6, 'title' => 'Velvet Navy / King', 'sku' => 'UKB-VNB-K', 'price' => 159900, 'inventory' => 8, 'status' => 1],

            // 2-Drawer Nightstand (product_id: 7)
            ['product_id' => 7, 'title' => 'White', 'sku' => '2DN-WHT-S', 'price' => 19900, 'inventory' => 40, 'status' => 1],
            ['product_id' => 7, 'title' => 'Walnut', 'sku' => '2DN-WAL-S', 'price' => 21900, 'inventory' => 35, 'status' => 1],

            // Standing Desk Electric (product_id: 8)
            ['product_id' => 8, 'title' => 'White Top / Black Frame', 'sku' => 'SDE-WBF-L', 'price' => 69900, 'inventory' => 20, 'status' => 1],
            ['product_id' => 8, 'title' => 'Oak Top / Black Frame', 'sku' => 'SDE-OBF-L', 'price' => 74900, 'inventory' => 15, 'status' => 1],

            // Executive Office Desk (product_id: 9)
            ['product_id' => 9, 'title' => 'Dark Walnut', 'sku' => 'EOD-DWK-XL', 'price' => 119900, 'inventory' => 7, 'status' => 1],

            // Ergonomic Mesh Chair (product_id: 10)
            ['product_id' => 10, 'title' => 'Black Mesh', 'sku' => 'EMC-BLK-M', 'price' => 44900, 'inventory' => 50, 'status' => 1],
            ['product_id' => 10, 'title' => 'Gray Mesh', 'sku' => 'EMC-GRY-M', 'price' => 44900, 'inventory' => 45, 'status' => 1],

            // Extendable Dining Table (product_id: 11)
            ['product_id' => 11, 'title' => 'Natural Oak', 'sku' => 'EDT-NOA-L', 'price' => 149900, 'inventory' => 9, 'status' => 1],

            // Leather Dining Chair (product_id: 12)
            ['product_id' => 12, 'title' => 'Black Leather / Gold Legs', 'sku' => 'LDC-BLG-S', 'price' => 29900, 'inventory' => 60, 'status' => 1],
            ['product_id' => 12, 'title' => 'Brown Leather / Black Legs', 'sku' => 'LDC-BRB-S', 'price' => 27900, 'inventory' => 55, 'status' => 1],
        ];

        foreach ($variants as $variant) {
            ProductVariant::create($variant);
        }
    }
}
