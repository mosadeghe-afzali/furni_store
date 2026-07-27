<?php

namespace Database\Seeders;

use App\Models\AttributeValue;
use Illuminate\Database\Seeder;

class AttributeValueSeeder extends Seeder
{
    public function run(): void
    {
        // رنگ (attribute_id: 1)
        $colors = ['مشکی', 'سفید', 'قهوه‌ای', 'خاکستری', 'سرمه‌ای', 'بژ', 'سبز', 'قرمز'];
        foreach ($colors as $color) {
            AttributeValue::create(['attribute_id' => 1, 'value' => $color]);
        }

        // جنس (attribute_id: 2)
        $materials = ['چوب طبیعی', 'چوب مصنوعی', 'فلز', 'پارچه', 'چرم', 'مخمل', 'سنگ مرمر', 'شیشه'];
        foreach ($materials as $material) {
            AttributeValue::create(['attribute_id' => 2, 'value' => $material]);
        }

        // اندازه (attribute_id: 3)
        $sizes = ['کوچک', 'متوسط', 'بزرگ', 'خیلی بزرگ'];
        foreach ($sizes as $size) {
            AttributeValue::create(['attribute_id' => 3, 'value' => $size]);
        }

        // وزن (attribute_id: 4)
        $weights = ['۵', '۱۰', '۱۵', '۲۰', '۳۰', '۵۰'];
        foreach ($weights as $weight) {
            AttributeValue::create(['attribute_id' => 4, 'value' => $weight]);
        }

        // عرض (attribute_id: 5)
        $widths = ['۶۰', '۸۰', '۱۰۰', '۱۲۰', '۱۵۰', '۱۸۰', '۲۰۰'];
        foreach ($widths as $width) {
            AttributeValue::create(['attribute_id' => 5, 'value' => $width]);
        }

        // ارتفاع (attribute_id: 6)
        $heights = ['۴۰', '۵۰', '۶۰', '۷۵', '۸۵', '۱۰۰', '۱۲۰'];
        foreach ($heights as $height) {
            AttributeValue::create(['attribute_id' => 6, 'value' => $height]);
        }

        // عمق (attribute_id: 7)
        $depths = ['۳۰', '۴۰', '۵۰', '۶۰', '۷۰', '۸۰', '۹۰'];
        foreach ($depths as $depth) {
            AttributeValue::create(['attribute_id' => 7, 'value' => $depth]);
        }
    }
}
