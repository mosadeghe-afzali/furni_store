<?php

namespace Database\Seeders;

use App\Models\AttributeValue;
use Illuminate\Database\Seeder;

class AttributeValueSeeder extends Seeder
{
    public function run(): void
    {
        // Color (attribute_id: 1)
        $colors = ['Black', 'White', 'Brown', 'Gray', 'Navy Blue', 'Beige', 'Green', 'Red'];
        foreach ($colors as $color) {
            AttributeValue::create(['attribute_id' => 1, 'value' => $color]);
        }

        // Material (attribute_id: 2)
        $materials = ['Solid Wood', 'Engineered Wood', 'Metal', 'Fabric', 'Leather', 'Velvet', 'Marble', 'Glass'];
        foreach ($materials as $material) {
            AttributeValue::create(['attribute_id' => 2, 'value' => $material]);
        }

        // Size (attribute_id: 3)
        $sizes = ['Small', 'Medium', 'Large', 'Extra Large'];
        foreach ($sizes as $size) {
            AttributeValue::create(['attribute_id' => 3, 'value' => $size]);
        }

        // Weight (attribute_id: 4)
        $weights = ['5', '10', '15', '20', '30', '50'];
        foreach ($weights as $weight) {
            AttributeValue::create(['attribute_id' => 4, 'value' => $weight]);
        }

        // Width (attribute_id: 5)
        $widths = ['60', '80', '100', '120', '150', '180', '200'];
        foreach ($widths as $width) {
            AttributeValue::create(['attribute_id' => 5, 'value' => $width]);
        }

        // Height (attribute_id: 6)
        $heights = ['40', '50', '60', '75', '85', '100', '120'];
        foreach ($heights as $height) {
            AttributeValue::create(['attribute_id' => 6, 'value' => $height]);
        }

        // Depth (attribute_id: 7)
        $depths = ['30', '40', '50', '60', '70', '80', '90'];
        foreach ($depths as $depth) {
            AttributeValue::create(['attribute_id' => 7, 'value' => $depth]);
        }
    }
}
