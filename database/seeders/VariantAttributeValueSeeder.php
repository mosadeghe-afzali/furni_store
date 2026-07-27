<?php

namespace Database\Seeders;

use App\Models\VariantAttributeValue;
use Illuminate\Database\Seeder;


class VariantAttributeValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
         * Attribute Value IDs (from AttributeValueSeeder):
         * رنگ (Color):      1=مشکی, 2=سفید, 3=قهوه‌ای, 4=خاکستری, 5=سرمه‌ای, 6=بژ, 7=سبز, 8=قرمز
         * جنس (Material):   9=چوب طبیعی, 10=چوب مصنوعی, 11=فلز, 12=پارچه, 13=چرم, 14=مخمل, 15=سنگ مرمر, 16=شیشه
         * اندازه (Size):    17=کوچک, 18=متوسط, 19=بزرگ, 20=خیلی بزرگ
         * وزن (Weight):     21=۵, 22=۱۰, 23=۱۵, 24=۲۰, 25=۳۰, 26=۵۰
         * عرض (Width):      27=۶۰, 28=۸۰, 29=۱۰۰, 30=۱۲۰, 31=۱۵۰, 32=۱۸۰, 33=۲۰۰
         * ارتفاع (Height):  34=۴۰, 35=۵۰, 36=۶۰, 37=۷۵, 38=۸۵, 39=۱۰۰, 40=۱۲۰
         * عمق (Depth):      41=۳۰, 42=۴۰, 43=۵۰, 44=۶۰, 45=۷۰, 46=۸۰, 47=۹۰
         */

        $pivotData = [
            // Variant 1: خاکستری،پارچه بزرگ
            ['variant_id' => 1, 'attribute_value_id' => 4],   // خاکستری
            ['variant_id' => 1, 'attribute_value_id' => 12],  // پارچه
            ['variant_id' => 1, 'attribute_value_id' => 19],  // بزرگ
            ['variant_id' => 1, 'attribute_value_id' => 26],  // ۵۰ کیلو
            ['variant_id' => 1, 'attribute_value_id' => 33],  // عرض ۲۰۰
            ['variant_id' => 1, 'attribute_value_id' => 35],  // ارتفاع ۵۰
            ['variant_id' => 1, 'attribute_value_id' => 47],  // عمق ۹۰

            // Variant 2: سرمه‌ای،پارچه بزرگ
            ['variant_id' => 2, 'attribute_value_id' => 5],   // سرمه‌ای
            ['variant_id' => 2, 'attribute_value_id' => 12],  // پارچه
            ['variant_id' => 2, 'attribute_value_id' => 19],  // بزرگ
            ['variant_id' => 2, 'attribute_value_id' => 26],  // ۵۰ کیلو
            ['variant_id' => 2, 'attribute_value_id' => 33],  // عرض ۲۰۰
            ['variant_id' => 2, 'attribute_value_id' => 35],  // ارتفاع ۵۰
            ['variant_id' => 2, 'attribute_value_id' => 47],  // عمق ۹۰

            // Variant 3: قهوه‌ای،چرم بزرگ
            ['variant_id' => 3, 'attribute_value_id' => 3],   // قهوه‌ای
            ['variant_id' => 3, 'attribute_value_id' => 13],  // چرم
            ['variant_id' => 3, 'attribute_value_id' => 19],  // بزرگ
            ['variant_id' => 3, 'attribute_value_id' => 26],  // ۵۰ کیلو
            ['variant_id' => 3, 'attribute_value_id' => 32],  // عرض ۱۸۰
            ['variant_id' => 3, 'attribute_value_id' => 36],  // ارتفاع ۶۰
            ['variant_id' => 3, 'attribute_value_id' => 46],  // عمق ۸۰

            // Variant 4: مشکی،چرم بزرگ (0 inventory)
            ['variant_id' => 4, 'attribute_value_id' => 1],   // مشکی
            ['variant_id' => 4, 'attribute_value_id' => 13],  // چرم
            ['variant_id' => 4, 'attribute_value_id' => 19],  // بزرگ
            ['variant_id' => 4, 'attribute_value_id' => 26],  // ۵۰ کیلو
            ['variant_id' => 4, 'attribute_value_id' => 32],  // عرض ۱۸۰
            ['variant_id' => 4, 'attribute_value_id' => 36],  // ارتفاع ۶۰
            ['variant_id' => 4, 'attribute_value_id' => 46],  // عمق ۸۰

            // Variant 5: سفید،سنگ مرمر متوسط
            ['variant_id' => 5, 'attribute_value_id' => 2],   // سفید
            ['variant_id' => 5, 'attribute_value_id' => 15],  // سنگ مرمر
            ['variant_id' => 5, 'attribute_value_id' => 18],  // متوسط
            ['variant_id' => 5, 'attribute_value_id' => 23],  // ۱۵ کیلو
            ['variant_id' => 5, 'attribute_value_id' => 29],  // عرض ۱۰۰
            ['variant_id' => 5, 'attribute_value_id' => 34],  // ارتفاع ۴۰
            ['variant_id' => 5, 'attribute_value_id' => 43],  // عمق ۵۰

            // Variant 6: مشکی،سنگ مرمر متوسط
            ['variant_id' => 6, 'attribute_value_id' => 1],   // مشکی
            ['variant_id' => 6, 'attribute_value_id' => 15],  // سنگ مرمر
            ['variant_id' => 6, 'attribute_value_id' => 18],  // متوسط
            ['variant_id' => 6, 'attribute_value_id' => 24],  // ۲۰ کیلو
            ['variant_id' => 6, 'attribute_value_id' => 29],  // عرض ۱۰۰
            ['variant_id' => 6, 'attribute_value_id' => 34],  // ارتفاع ۴۰
            ['variant_id' => 6, 'attribute_value_id' => 43],  // عمق ۵۰

            // Variant 7: قهوه‌ای،چوب طبیعی متوسط
            ['variant_id' => 7, 'attribute_value_id' => 3],   // قهوه‌ای
            ['variant_id' => 7, 'attribute_value_id' => 9],   // چوب طبیعی
            ['variant_id' => 7, 'attribute_value_id' => 18],  // متوسط
            ['variant_id' => 7, 'attribute_value_id' => 24],  // ۲۰ کیلو
            ['variant_id' => 7, 'attribute_value_id' => 29],  // عرض ۱۰۰
            ['variant_id' => 7, 'attribute_value_id' => 34],  // ارتفاع ۴۰
            ['variant_id' => 7, 'attribute_value_id' => 44],  // عمق ۶۰

            // Variant 8: سفید،چوب طبیعی متوسط
            ['variant_id' => 8, 'attribute_value_id' => 2],   // سفید
            ['variant_id' => 8, 'attribute_value_id' => 9],   // چوب طبیعی
            ['variant_id' => 8, 'attribute_value_id' => 18],  // متوسط
            ['variant_id' => 8, 'attribute_value_id' => 26],  // ۵۰ کیلو
            ['variant_id' => 8, 'attribute_value_id' => 31],  // عرض ۱۵۰
            ['variant_id' => 8, 'attribute_value_id' => 35],  // ارتفاع ۵۰
            ['variant_id' => 8, 'attribute_value_id' => 47],  // عمق ۹۰

            // Variant 9: مشکی،چوب طبیعی متوسط
            ['variant_id' => 9, 'attribute_value_id' => 1],   // مشکی
            ['variant_id' => 9, 'attribute_value_id' => 9],   // چوب طبیعی
            ['variant_id' => 9, 'attribute_value_id' => 18],  // متوسط
            ['variant_id' => 9, 'attribute_value_id' => 26],  // ۵۰ کیلو
            ['variant_id' => 9, 'attribute_value_id' => 31],  // عرض ۱۵۰
            ['variant_id' => 9, 'attribute_value_id' => 35],  // ارتفاع ۵۰
            ['variant_id' => 9, 'attribute_value_id' => 47],  // عمق ۹۰

            // Variant 10: سبز،مخمل خیلی بزرگ
            ['variant_id' => 10, 'attribute_value_id' => 7],  // سبز
            ['variant_id' => 10, 'attribute_value_id' => 14], // مخمل
            ['variant_id' => 10, 'attribute_value_id' => 20], // خیلی بزرگ
            ['variant_id' => 10, 'attribute_value_id' => 26], // ۵۰ کیلو
            ['variant_id' => 10, 'attribute_value_id' => 33], // عرض ۲۰۰
            ['variant_id' => 10, 'attribute_value_id' => 40], // ارتفاع ۱۲۰
            ['variant_id' => 10, 'attribute_value_id' => 47], // عمق ۹۰
        ];

        foreach ($pivotData as $item) {
            VariantAttributeValue::create($item);
        }
    }
}
