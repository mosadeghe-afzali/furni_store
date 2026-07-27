<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // اتاق نشیمن - مبل (category_id: 3)
            [
                'category_id' => 3,
                'name' => 'مبل ال شکل مدرن',
                'slug' => 'modern-l-shape-sofa',
                'description' => 'مبل ال شکل بزرگ با روکش پارچه مرغوب و فریم چوبی محکم.',
                'status' => 1,
            ],
            [
                'category_id' => 3,
                'name' => 'مبل کلاسیک چستر',
                'slug' => 'classic-chevronfield-sofa',
                'description' => 'مبل شیک با طراحی دکمه‌ای عمیق و دسته‌های گرد.',
                'status' => 1,
            ],
            // اتاق نشیمن - میز جلو مبلی (category_id: 4)
            [
                'category_id' => 4,
                'name' => 'میز جلو مبلی سنگ مرمر',
                'slug' => 'marble-top-coffee-table',
                'description' => 'میز جلو مبلی لوکس با روکش سنگ مرمر طبیعی و پایه‌های طلایی.',
                'status' => 1,
            ],
            [
                'category_id' => 4,
                'name' => 'میز جلو مبلی چوبی',
                'slug' => 'rustic-wooden-coffee-table',
                'description' => 'میز جلو مبلی از چوب راش با روکش طبیعی.',
                'status' => 1,
            ],
            // اتاق خواب - تخت خواب (category_id: 6)
            [
                'category_id' => 6,
                'name' => 'تخت خواب کوئین مینیمال',
                'slug' => 'platform-bed-queen',
                'description' => 'تخت خواب مینیمال با تخته سر تخت یکپارچه و فضای ذخیره‌سازی زیر تخت.',
                'status' => 1,
            ],
            [
                'category_id' => 6,
                'name' => 'تخت خواب کینگ روکش‌دار',
                'slug' => 'upholstered-king-bed',
                'description' => 'تخت خواب لوکس با فریم مخملی و تخته سر تخت دکمه‌ای.',
                'status' => 1,
            ],
            // اتاق خواب - کمد لباس (category_id: 7)
            [
                'category_id' => 7,
                'name' => 'کمد لباس دو کشو',
                'slug' => '2-drawer-wardrobe',
                'description' => 'کمد لباس کمپکت با دو کشو آرام‌بند و قفسه باز.',
                'status' => 0,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
