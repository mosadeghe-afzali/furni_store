<?php

namespace Database\Seeders;

use App\Models\Media;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;

class MediaSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            1 => [
                ['path' => 'https://placehold.co/800x600/gray/white?text=L-Sofa-1', 'type' => Media::TYPE_IMAGE, 'alt' => 'مبل ال شکل مدرن - نمای کلی', 'status' => Media::STATUS_ACTIVE, 'sort_order' => 1],
                ['path' => 'https://placehold.co/800x600/darkgray/white?text=L-Sofa-2', 'type' => Media::TYPE_IMAGE, 'alt' => 'مبل ال شکل مدرن - نمای جانبی', 'status' => Media::STATUS_ACTIVE, 'sort_order' => 2],
                ['path' => 'https://placehold.co/800x600/gray/white?text=L-Sofa-3', 'type' => Media::TYPE_IMAGE, 'alt' => 'مبل ال شکل مدرن - جزئیات پارچه', 'status' => Media::STATUS_ACTIVE, 'sort_order' => 3],
            ],
            2 => [
                ['path' => 'https://placehold.co/800x600/saddlebrown/white?text=Chester-1', 'type' => Media::TYPE_IMAGE, 'alt' => 'مبل کلاسیک چستر - نمای کلی', 'status' => Media::STATUS_ACTIVE, 'sort_order' => 1],
                ['path' => 'https://placehold.co/800x600/saddlebrown/white?text=Chester-2', 'type' => Media::TYPE_IMAGE, 'alt' => 'مبل کلاسیک چستر - نمای جلو', 'status' => Media::STATUS_ACTIVE, 'sort_order' => 2],
            ],
            3 => [
                ['path' => 'https://placehold.co/800x600/white/gray?text=Marble-1', 'type' => Media::TYPE_IMAGE, 'alt' => 'میز جلو مبلی سنگ مرمر - نمای کلی', 'status' => Media::STATUS_ACTIVE, 'sort_order' => 1],
                ['path' => 'https://placehold.co/800x600/white/gray?text=Marble-2', 'type' => Media::TYPE_IMAGE, 'alt' => 'میز جلو مبلی سنگ مرمر - نمای بالا', 'status' => Media::STATUS_ACTIVE, 'sort_order' => 2],
                ['path' => 'https://placehold.co/800x600/white/gray?text=Marble-3', 'type' => Media::TYPE_IMAGE, 'alt' => 'میز جلو مبلی سنگ مرمر - جزئیات پایه', 'status' => Media::STATUS_ACTIVE, 'sort_order' => 3],
            ],
            4 => [
                ['path' => 'https://placehold.co/800x600/peru/white?text=Wood-1', 'type' => Media::TYPE_IMAGE, 'alt' => 'میز جلو مبلی چوبی - نمای کلی', 'status' => Media::STATUS_ACTIVE, 'sort_order' => 1],
                ['path' => 'https://placehold.co/800x600/peru/white?text=Wood-2', 'type' => Media::TYPE_IMAGE, 'alt' => 'میز جلو مبلی چوبی - نمای جانبی', 'status' => Media::STATUS_ACTIVE, 'sort_order' => 2],
            ],
            5 => [
                ['path' => 'https://placehold.co/800x600/ivory/black?text=Queen-1', 'type' => Media::TYPE_IMAGE, 'alt' => 'تخت خواب کوئین مینیمال - نمای کلی', 'status' => Media::STATUS_ACTIVE, 'sort_order' => 1],
                ['path' => 'https://placehold.co/800x600/ivory/black?text=Queen-2', 'type' => Media::TYPE_IMAGE, 'alt' => 'تخت خواب کوئین مینیمال - فضای زیر تخت', 'status' => Media::STATUS_ACTIVE, 'sort_order' => 2],
            ],
            6 => [
                ['path' => 'https://placehold.co/800x600/forestgreen/white?text=King-1', 'type' => Media::TYPE_IMAGE, 'alt' => 'تخت خواب کینگ روکش‌دار - نمای کلی', 'status' => Media::STATUS_ACTIVE, 'sort_order' => 1],
                ['path' => 'https://placehold.co/800x600/forestgreen/white?text=King-2', 'type' => Media::TYPE_IMAGE, 'alt' => 'تخت خواب کینگ روکش‌دار - نمای جلو', 'status' => Media::STATUS_ACTIVE, 'sort_order' => 2],
                ['path' => 'https://placehold.co/800x600/forestgreen/white?text=King-3', 'type' => Media::TYPE_IMAGE, 'alt' => 'تخت خواب کینگ روکش‌دار - جزئیات دکمه‌ای', 'status' => Media::STATUS_ACTIVE, 'sort_order' => 3],
            ],
            7 => [
                ['path' => 'https://placehold.co/800x600/lightgray/black?text=Wardrobe-1', 'type' => Media::TYPE_IMAGE, 'alt' => 'کمد لباس دو کشو - نمای کلی', 'status' => Media::STATUS_ACTIVE, 'sort_order' => 1],
            ],
        ];

        foreach ($products as $productId => $mediaItems) {
            $product = Product::find($productId);
            if (!$product) continue;

            foreach ($mediaItems as $item) {
                $product->media()->create($item);
            }
        }

        $variants = [
            1 => [
                ['path' => 'https://placehold.co/800x600/gray/white?text=MLS-GRY-L', 'type' => Media::TYPE_IMAGE, 'alt' => 'خاکستری، پارچه بزرگ - نمای کلی', 'status' => Media::STATUS_ACTIVE, 'sort_order' => 1],
                ['path' => 'https://placehold.co/800x600/dimgray/white?text=MLS-GRY-L-2', 'type' => Media::TYPE_IMAGE, 'alt' => 'خاکستری، پارچه بزرگ - نمای نزدیک', 'status' => Media::STATUS_ACTIVE, 'sort_order' => 2],
            ],
            2 => [
                ['path' => 'https://placehold.co/800x600/navy/white?text=MLS-NBY-L', 'type' => Media::TYPE_IMAGE, 'alt' => 'سرمه‌ای، پارچه بزرگ - نمای کلی', 'status' => Media::STATUS_ACTIVE, 'sort_order' => 1],
            ],
            3 => [
                ['path' => 'https://placehold.co/800x600/saddlebrown/white?text=CCS-BRN-L', 'type' => Media::TYPE_IMAGE, 'alt' => 'قهوه‌ای، چرم بزرگ - نمای کلی', 'status' => Media::STATUS_ACTIVE, 'sort_order' => 1],
                ['path' => 'https://placehold.co/800x600/saddlebrown/white?text=CCS-BRN-L-2', 'type' => Media::TYPE_IMAGE, 'alt' => 'قهوه‌ای، چرم بزرگ - جزئیات چرم', 'status' => Media::STATUS_ACTIVE, 'sort_order' => 2],
            ],
            4 => [
                ['path' => 'https://placehold.co/800x600/black/white?text=CCS-BLK-L', 'type' => Media::TYPE_IMAGE, 'alt' => 'مشکی، چرم بزرگ - نمای کلی', 'status' => Media::STATUS_ACTIVE, 'sort_order' => 1],
            ],
            5 => [
                ['path' => 'https://placehold.co/800x600/white/gray?text=MCT-WMG-M', 'type' => Media::TYPE_IMAGE, 'alt' => 'سفید، سنگ مرمر متوسط - نمای کلی', 'status' => Media::STATUS_ACTIVE, 'sort_order' => 1],
            ],
            6 => [
                ['path' => 'https://placehold.co/800x600/black/white?text=MCT-BKG-M', 'type' => Media::TYPE_IMAGE, 'alt' => 'مشکی، سنگ مرمر متوسط - نمای کلی', 'status' => Media::STATUS_ACTIVE, 'sort_order' => 1],
                ['path' => 'https://placehold.co/800x600/black/white?text=MCT-BKG-M-2', 'type' => Media::TYPE_IMAGE, 'alt' => 'مشکی، سنگ مرمر متوسط - نمای بالا', 'status' => Media::STATUS_ACTIVE, 'sort_order' => 2],
            ],
            7 => [
                ['path' => 'https://placehold.co/800x600/peru/white?text=RWT-NAT-M', 'type' => Media::TYPE_IMAGE, 'alt' => 'قهوه‌ای، چوب طبیعی متوسط - نمای کلی', 'status' => Media::STATUS_ACTIVE, 'sort_order' => 1],
            ],
            8 => [
                ['path' => 'https://placehold.co/800x600/ivory/black?text=PBQ-WHO-Q', 'type' => Media::TYPE_IMAGE, 'alt' => 'سفید، چوب طبیعی متوسط - نمای کلی', 'status' => Media::STATUS_ACTIVE, 'sort_order' => 1],
            ],
            9 => [
                ['path' => 'https://placehold.co/800x600/black/white?text=PBQ-BKA-Q', 'type' => Media::TYPE_IMAGE, 'alt' => 'مشکی، چوب طبیعی متوسط - نمای کلی', 'status' => Media::STATUS_ACTIVE, 'sort_order' => 1],
                ['path' => 'https://placehold.co/800x600/black/white?text=PBQ-BKA-Q-2', 'type' => Media::TYPE_IMAGE, 'alt' => 'مشکی، چوب طبیعی متوسط - نمای جانبی', 'status' => Media::STATUS_ACTIVE, 'sort_order' => 2],
            ],
            10 => [
                ['path' => 'https://placehold.co/800x600/forestgreen/white?text=UKB-VGR-K', 'type' => Media::TYPE_IMAGE, 'alt' => 'سبز، مخمل خیلی بزرگ - نمای کلی', 'status' => Media::STATUS_ACTIVE, 'sort_order' => 1],
                ['path' => 'https://placehold.co/800x600/forestgreen/white?text=UKB-VGR-K-2', 'type' => Media::TYPE_IMAGE, 'alt' => 'سبز، مخمل خیلی بزرگ - جزئیات مخمل', 'status' => Media::STATUS_ACTIVE, 'sort_order' => 2],
            ],
        ];

        foreach ($variants as $variantId => $mediaItems) {
            $variant = ProductVariant::find($variantId);
            if (!$variant) continue;

            foreach ($mediaItems as $item) {
                $variant->media()->create($item);
            }
        }
    }
}
