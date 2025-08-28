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
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->foreignUuid('customer_id')->constrained('customers')->cascadeOnDelete();
            $table->string('tracking_number')->unique();
            $table->foreignUuid('category_id')->constrained('categories')->cascadeOnDelete();
            $table->foreignUuid('origin_location_id')->constrained('locations')->cascadeOnDelete();
            $table->foreignUuid('destination_location_id')->constrained('locations')->cascadeOnDelete();
            $table->decimal('weight', 8, 2)->nullable();
            $table->decimal('length', 8, 2)->nullable();
            $table->decimal('width', 8, 2)->nullable();
            $table->decimal('height', 8, 2)->nullable();
            $table->decimal('price', 10, 2);
            $table->string('status')->default('pending');
            $table->string('receiver_name');
            $table->string('receiver_email')->nullable();
            $table->string('receiver_phone');
            $table->text('receiver_address')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('requires_delivery_confirmation')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
