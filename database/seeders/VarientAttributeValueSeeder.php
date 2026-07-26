<?php

namespace Database\Seeders;

use App\Models\VarientAttributeValue;
use Illuminate\Database\Seeder;

class VarientAttributeValueSeeder extends Seeder
{
    public function run(): void
    {
        /*
         * Attribute Value IDs (from AttributeValueSeeder):
         * Color:     1=Black, 2=White, 3=Brown, 4=Gray, 5=Navy Blue, 6=Beige, 7=Green, 8=Red
         * Material:  9=Solid Wood, 10=Engineered Wood, 11=Metal, 12=Fabric, 13=Leather, 14=Velvet, 15=Marble, 16=Glass
         * Size:      17=Small, 18=Medium, 19=Large, 20=Extra Large
         * Weight:    21=5, 22=10, 23=15, 24=20, 25=30, 26=50
         * Width:     27=60, 28=80, 29=100, 30=120, 31=150, 32=180, 33=200
         * Height:    34=40, 35=50, 36=60, 37=75, 38=85, 39=100, 40=120
         * Depth:     41=30, 42=40, 43=50, 44=60, 45=70, 46=80, 47=90
         */

        $pivotData = [
            // Modern L-Shape Sofa variants
            // Variant 1: Gray / Large
            ['variant_id' => 1, 'attribute_value_id' => 4],   // Gray
            ['variant_id' => 1, 'attribute_value_id' => 12],  // Fabric
            ['variant_id' => 1, 'attribute_value_id' => 19],  // Large
            ['variant_id' => 1, 'attribute_value_id' => 26],  // 50kg
            ['variant_id' => 1, 'attribute_value_id' => 33],  // 200cm width
            ['variant_id' => 1, 'attribute_value_id' => 35],  // 50cm height
            ['variant_id' => 1, 'attribute_value_id' => 47],  // 90cm depth

            // Variant 2: Navy Blue / Large
            ['variant_id' => 2, 'attribute_value_id' => 5],   // Navy Blue
            ['variant_id' => 2, 'attribute_value_id' => 12],  // Fabric
            ['variant_id' => 2, 'attribute_value_id' => 19],  // Large
            ['variant_id' => 2, 'attribute_value_id' => 26],  // 50kg
            ['variant_id' => 2, 'attribute_value_id' => 33],  // 200cm width
            ['variant_id' => 2, 'attribute_value_id' => 35],  // 50cm height
            ['variant_id' => 2, 'attribute_value_id' => 47],  // 90cm depth

            // Variant 3: Beige / Medium
            ['variant_id' => 3, 'attribute_value_id' => 6],   // Beige
            ['variant_id' => 3, 'attribute_value_id' => 12],  // Fabric
            ['variant_id' => 3, 'attribute_value_id' => 18],  // Medium
            ['variant_id' => 3, 'attribute_value_id' => 25],  // 30kg
            ['variant_id' => 3, 'attribute_value_id' => 31],  // 150cm width
            ['variant_id' => 3, 'attribute_value_id' => 35],  // 50cm height
            ['variant_id' => 3, 'attribute_value_id' => 45],  // 70cm depth

            // Classic Chesterfield Sofa
            // Variant 4: Brown Leather
            ['variant_id' => 4, 'attribute_value_id' => 3],   // Brown
            ['variant_id' => 4, 'attribute_value_id' => 13],  // Leather
            ['variant_id' => 4, 'attribute_value_id' => 19],  // Large
            ['variant_id' => 4, 'attribute_value_id' => 26],  // 50kg
            ['variant_id' => 4, 'attribute_value_id' => 32],  // 180cm width
            ['variant_id' => 4, 'attribute_value_id' => 36],  // 60cm height
            ['variant_id' => 4, 'attribute_value_id' => 46],  // 80cm depth

            // Variant 5: Black Leather
            ['variant_id' => 5, 'attribute_value_id' => 1],   // Black
            ['variant_id' => 5, 'attribute_value_id' => 13],  // Leather
            ['variant_id' => 5, 'attribute_value_id' => 19],  // Large
            ['variant_id' => 5, 'attribute_value_id' => 26],  // 50kg
            ['variant_id' => 5, 'attribute_value_id' => 32],  // 180cm width
            ['variant_id' => 5, 'attribute_value_id' => 36],  // 60cm height
            ['variant_id' => 5, 'attribute_value_id' => 46],  // 80cm depth

            // Marble Top Coffee Table
            // Variant 6: White Marble / Gold
            ['variant_id' => 6, 'attribute_value_id' => 2],   // White
            ['variant_id' => 6, 'attribute_value_id' => 15],  // Marble
            ['variant_id' => 6, 'attribute_value_id' => 18],  // Medium
            ['variant_id' => 6, 'attribute_value_id' => 23],  // 15kg
            ['variant_id' => 6, 'attribute_value_id' => 29],  // 100cm width
            ['variant_id' => 6, 'attribute_value_id' => 34],  // 40cm height
            ['variant_id' => 6, 'attribute_value_id' => 43],  // 50cm depth

            // Variant 7: Black Marble / Gold
            ['variant_id' => 7, 'attribute_value_id' => 1],   // Black
            ['variant_id' => 7, 'attribute_value_id' => 15],  // Marble
            ['variant_id' => 7, 'attribute_value_id' => 18],  // Medium
            ['variant_id' => 7, 'attribute_value_id' => 24],  // 20kg
            ['variant_id' => 7, 'attribute_value_id' => 29],  // 100cm width
            ['variant_id' => 7, 'attribute_value_id' => 34],  // 40cm height
            ['variant_id' => 7, 'attribute_value_id' => 43],  // 50cm depth

            // Rustic Wooden Coffee Table
            // Variant 8: Natural Finish
            ['variant_id' => 8, 'attribute_value_id' => 3],   // Brown (natural)
            ['variant_id' => 8, 'attribute_value_id' => 9],   // Solid Wood
            ['variant_id' => 8, 'attribute_value_id' => 18],  // Medium
            ['variant_id' => 8, 'attribute_value_id' => 24],  // 20kg
            ['variant_id' => 8, 'attribute_value_id' => 29],  // 100cm width
            ['variant_id' => 8, 'attribute_value_id' => 34],  // 40cm height
            ['variant_id' => 8, 'attribute_value_id' => 44],  // 60cm depth

            // Variant 9: Dark Walnut
            ['variant_id' => 9, 'attribute_value_id' => 3],   // Brown
            ['variant_id' => 9, 'attribute_value_id' => 9],   // Solid Wood
            ['variant_id' => 9, 'attribute_value_id' => 18],  // Medium
            ['variant_id' => 9, 'attribute_value_id' => 24],  // 20kg
            ['variant_id' => 9, 'attribute_value_id' => 29],  // 100cm width
            ['variant_id' => 9, 'attribute_value_id' => 34],  // 40cm height
            ['variant_id' => 9, 'attribute_value_id' => 44],  // 60cm depth

            // Platform Bed Queen
            // Variant 10: White Oak
            ['variant_id' => 10, 'attribute_value_id' => 2],  // White
            ['variant_id' => 10, 'attribute_value_id' => 9],  // Solid Wood
            ['variant_id' => 10, 'attribute_value_id' => 18], // Medium
            ['variant_id' => 10, 'attribute_value_id' => 26], // 50kg
            ['variant_id' => 10, 'attribute_value_id' => 31], // 150cm width
            ['variant_id' => 10, 'attribute_value_id' => 35], // 50cm height
            ['variant_id' => 10, 'attribute_value_id' => 47], // 90cm depth

            // Variant 11: Black Ash
            ['variant_id' => 11, 'attribute_value_id' => 1],  // Black
            ['variant_id' => 11, 'attribute_value_id' => 9],  // Solid Wood
            ['variant_id' => 11, 'attribute_value_id' => 18], // Medium
            ['variant_id' => 11, 'attribute_value_id' => 26], // 50kg
            ['variant_id' => 11, 'attribute_value_id' => 31], // 150cm width
            ['variant_id' => 11, 'attribute_value_id' => 35], // 50cm height
            ['variant_id' => 11, 'attribute_value_id' => 47], // 90cm depth

            // Upholstered King Bed
            // Variant 12: Velvet Green / King
            ['variant_id' => 12, 'attribute_value_id' => 7],  // Green
            ['variant_id' => 12, 'attribute_value_id' => 14], // Velvet
            ['variant_id' => 12, 'attribute_value_id' => 20], // Extra Large
            ['variant_id' => 12, 'attribute_value_id' => 26], // 50kg
            ['variant_id' => 12, 'attribute_value_id' => 33], // 200cm width
            ['variant_id' => 12, 'attribute_value_id' => 40], // 120cm height
            ['variant_id' => 12, 'attribute_value_id' => 47], // 90cm depth

            // Variant 13: Velvet Navy / King
            ['variant_id' => 13, 'attribute_value_id' => 5],  // Navy Blue
            ['variant_id' => 13, 'attribute_value_id' => 14], // Velvet
            ['variant_id' => 13, 'attribute_value_id' => 20], // Extra Large
            ['variant_id' => 13, 'attribute_value_id' => 26], // 50kg
            ['variant_id' => 13, 'attribute_value_id' => 33], // 200cm width
            ['variant_id' => 13, 'attribute_value_id' => 40], // 120cm height
            ['variant_id' => 13, 'attribute_value_id' => 47], // 90cm depth

            // 2-Drawer Nightstand
            // Variant 14: White
            ['variant_id' => 14, 'attribute_value_id' => 2],  // White
            ['variant_id' => 14, 'attribute_value_id' => 10], // Engineered Wood
            ['variant_id' => 14, 'attribute_value_id' => 17], // Small
            ['variant_id' => 14, 'attribute_value_id' => 21], // 5kg
            ['variant_id' => 14, 'attribute_value_id' => 27], // 60cm width
            ['variant_id' => 14, 'attribute_value_id' => 34], // 40cm height
            ['variant_id' => 14, 'attribute_value_id' => 42], // 40cm depth

            // Variant 15: Walnut
            ['variant_id' => 15, 'attribute_value_id' => 3],  // Brown
            ['variant_id' => 15, 'attribute_value_id' => 10], // Engineered Wood
            ['variant_id' => 15, 'attribute_value_id' => 17], // Small
            ['variant_id' => 15, 'attribute_value_id' => 22], // 10kg
            ['variant_id' => 15, 'attribute_value_id' => 27], // 60cm width
            ['variant_id' => 15, 'attribute_value_id' => 34], // 40cm height
            ['variant_id' => 15, 'attribute_value_id' => 42], // 40cm depth

            // Standing Desk Electric
            // Variant 16: White Top / Black Frame
            ['variant_id' => 16, 'attribute_value_id' => 2],  // White
            ['variant_id' => 16, 'attribute_value_id' => 16], // Glass (laminate top)
            ['variant_id' => 16, 'attribute_value_id' => 11], // Metal
            ['variant_id' => 16, 'attribute_value_id' => 20], // Extra Large
            ['variant_id' => 16, 'attribute_value_id' => 25], // 30kg
            ['variant_id' => 16, 'attribute_value_id' => 33], // 200cm width
            ['variant_id' => 16, 'attribute_value_id' => 39], // 100cm height (adjustable)
            ['variant_id' => 16, 'attribute_value_id' => 44], // 60cm depth

            // Variant 17: Oak Top / Black Frame
            ['variant_id' => 17, 'attribute_value_id' => 3],  // Brown
            ['variant_id' => 17, 'attribute_value_id' => 9],  // Solid Wood
            ['variant_id' => 17, 'attribute_value_id' => 11], // Metal
            ['variant_id' => 17, 'attribute_value_id' => 20], // Extra Large
            ['variant_id' => 17, 'attribute_value_id' => 25], // 30kg
            ['variant_id' => 17, 'attribute_value_id' => 33], // 200cm width
            ['variant_id' => 17, 'attribute_value_id' => 39], // 100cm height
            ['variant_id' => 17, 'attribute_value_id' => 44], // 60cm depth

            // Executive Office Desk
            // Variant 18: Dark Walnut
            ['variant_id' => 18, 'attribute_value_id' => 3],  // Brown
            ['variant_id' => 18, 'attribute_value_id' => 9],  // Solid Wood
            ['variant_id' => 18, 'attribute_value_id' => 20], // Extra Large
            ['variant_id' => 18, 'attribute_value_id' => 26], // 50kg
            ['variant_id' => 18, 'attribute_value_id' => 33], // 200cm width
            ['variant_id' => 18, 'attribute_value_id' => 38], // 85cm height
            ['variant_id' => 18, 'attribute_value_id' => 47], // 90cm depth

            // Ergonomic Mesh Chair
            // Variant 19: Black Mesh
            ['variant_id' => 19, 'attribute_value_id' => 1],  // Black
            ['variant_id' => 19, 'attribute_value_id' => 12], // Fabric (mesh)
            ['variant_id' => 19, 'attribute_value_id' => 18], // Medium
            ['variant_id' => 19, 'attribute_value_id' => 22], // 10kg
            ['variant_id' => 19, 'attribute_value_id' => 28], // 80cm width
            ['variant_id' => 19, 'attribute_value_id' => 39], // 100cm height
            ['variant_id' => 19, 'attribute_value_id' => 43], // 50cm depth

            // Variant 20: Gray Mesh
            ['variant_id' => 20, 'attribute_value_id' => 4],  // Gray
            ['variant_id' => 20, 'attribute_value_id' => 12], // Fabric (mesh)
            ['variant_id' => 20, 'attribute_value_id' => 18], // Medium
            ['variant_id' => 20, 'attribute_value_id' => 22], // 10kg
            ['variant_id' => 20, 'attribute_value_id' => 28], // 80cm width
            ['variant_id' => 20, 'attribute_value_id' => 39], // 100cm height
            ['variant_id' => 20, 'attribute_value_id' => 43], // 50cm depth

            // Extendable Dining Table
            // Variant 21: Natural Oak
            ['variant_id' => 21, 'attribute_value_id' => 3],  // Brown
            ['variant_id' => 21, 'attribute_value_id' => 9],  // Solid Wood
            ['variant_id' => 21, 'attribute_value_id' => 20], // Extra Large
            ['variant_id' => 21, 'attribute_value_id' => 26], // 50kg
            ['variant_id' => 21, 'attribute_value_id' => 33], // 200cm width
            ['variant_id' => 21, 'attribute_value_id' => 37], // 75cm height
            ['variant_id' => 21, 'attribute_value_id' => 46], // 80cm depth

            // Leather Dining Chair
            // Variant 22: Black Leather / Gold Legs
            ['variant_id' => 22, 'attribute_value_id' => 1],  // Black
            ['variant_id' => 22, 'attribute_value_id' => 13], // Leather
            ['variant_id' => 22, 'attribute_value_id' => 11], // Metal
            ['variant_id' => 22, 'attribute_value_id' => 17], // Small
            ['variant_id' => 22, 'attribute_value_id' => 21], // 5kg
            ['variant_id' => 22, 'attribute_value_id' => 27], // 60cm width
            ['variant_id' => 22, 'attribute_value_id' => 36], // 60cm height
            ['variant_id' => 22, 'attribute_value_id' => 42], // 40cm depth

            // Variant 23: Brown Leather / Black Legs
            ['variant_id' => 23, 'attribute_value_id' => 3],  // Brown
            ['variant_id' => 23, 'attribute_value_id' => 13], // Leather
            ['variant_id' => 23, 'attribute_value_id' => 11], // Metal
            ['variant_id' => 23, 'attribute_value_id' => 17], // Small
            ['variant_id' => 23, 'attribute_value_id' => 21], // 5kg
            ['variant_id' => 23, 'attribute_value_id' => 27], // 60cm width
            ['variant_id' => 23, 'attribute_value_id' => 36], // 60cm height
            ['variant_id' => 23, 'attribute_value_id' => 42], // 40cm depth
        ];

        foreach ($pivotData as $item) {
            VarientAttributeValue::create($item);
        }
    }
}
