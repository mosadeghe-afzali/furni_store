<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('varient_attribute_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('variant_id')
                  ->constrained('product_variants')
                  ->cascadeOnDelete();
            $table->foreignId('attribute_value_id')
                  ->constrained('attribute_values')
                  ->cascadeOnDelete();
            $table->timestamps();

            $table->primary(['variant_id', 'attribute_value_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('varient_attribute_values');
    }
};
