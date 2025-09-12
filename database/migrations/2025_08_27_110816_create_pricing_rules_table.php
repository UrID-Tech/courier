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
        Schema::create('pricing_rules', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->foreignUuid('category_id')->constrained('categories')->cascadeOnDelete();
            $table->foreignUuid('origin_location_id')->nullable()->constrained('locations')->cascadeOnDelete();
            $table->foreignUuid('destination_location_id')->nullable()->constrained('locations')->cascadeOnDelete();
            $table->decimal('base_price', 10, 2)->default(0);
            $table->decimal('price_per_kg', 10, 2)->nullable();
            $table->decimal('price_per_dimension', 10, 2)->nullable();
            $table->decimal('min_weight', 8, 2)->nullable();
            $table->decimal('max_weight', 8, 2)->nullable();
            $table->decimal('min_length', 8, 2)->nullable();
            $table->decimal('max_length', 8, 2)->nullable();
            $table->decimal('min_width', 8, 2)->nullable();
            $table->decimal('max_width', 8, 2)->nullable();
            $table->decimal('min_height', 8, 2)->nullable();
            $table->decimal('max_height', 8, 2)->nullable();
            $table->boolean('is_reversible')->default(true);
            $table->decimal('value_percentage', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricing_rules');
    }
};
