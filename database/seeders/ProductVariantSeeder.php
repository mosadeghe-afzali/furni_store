<?php

namespace Database\Seeders;

use App\Models\ProductVariant;
use Illuminate\Database\Seeder;

class ProductVariantSeeder extends Seeder
{
    public function run(): void
    {
        $variants = [
            // مبل ال شکل مدرن (product_id: 1)
            ['product_id' => 1, 'title' => 'خاکستری،پارچه بزرگ', 'sku' => 'MLS-GRY-L', 'price' => 129900, 'inventory' => 15, 'status' => 1],
            ['product_id' => 1, 'title' => 'سرمه‌ای،پارچه بزرگ', 'sku' => 'MLS-NBY-L', 'price' => 134900, 'inventory' => 10, 'status' => 1],
            // مبل کلاسیک چستر (product_id: 2)
            ['product_id' => 2, 'title' => 'قهوه‌ای،چرم بزرگ', 'sku' => 'CCS-BRN-L', 'price' => 189900, 'inventory' => 8, 'status' => 1],
            ['product_id' => 2, 'title' => 'مشکی،چرم بزرگ', 'sku' => 'CCS-BLK-L', 'price' => 189900, 'inventory' => 0, 'status' => 1],
            // میز جلو مبلی سنگ مرمر (product_id: 3)
            ['product_id' => 3, 'title' => 'سفید،سنگ مرمر متوسط', 'sku' => 'MCT-WMG-M', 'price' => 49900, 'inventory' => 25, 'status' => 1],
            ['product_id' => 3, 'title' => 'مشکی،سنگ مرمر متوسط', 'sku' => 'MCT-BKG-M', 'price' => 52900, 'inventory' => 18, 'status' => 1],
            // میز جلو مبلی چوبی (product_id: 4)
            ['product_id' => 4, 'title' => 'قهوه‌ای،چوب طبیعی متوسط', 'sku' => 'RWT-NAT-M', 'price' => 34900, 'inventory' => 30, 'status' => 1],
            // تخت خواب کوئین مینیمال (product_id: 5)
            ['product_id' => 5, 'title' => 'سفید،چوب طبیعی متوسط', 'sku' => 'PBQ-WHO-Q', 'price' => 89900, 'inventory' => 12, 'status' => 1],
            ['product_id' => 5, 'title' => 'مشکی،چوب طبیعی متوسط', 'sku' => 'PBQ-BKA-Q', 'price' => 89900, 'inventory' => 10, 'status' => 1],
            // تخت خواب کینگ روکش‌دار (product_id: 6)
            ['product_id' => 6, 'title' => 'سبز،مخمل خیلی بزرگ', 'sku' => 'UKB-VGR-K', 'price' => 159900, 'inventory' => 6, 'status' => 1],
        ];

        foreach ($variants as $variant) {
            ProductVariant::create($variant);
        }
    }
}
