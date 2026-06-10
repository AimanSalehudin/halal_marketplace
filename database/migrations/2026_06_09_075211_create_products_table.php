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
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('category');
        $table->decimal('price', 8, 2);
        $table->integer('stock');
        $table->boolean('is_halal_certified')->default(true);
                    $table->string('image_url')->nullable();
        // In your create_products_table migration
        $table->string('vendor_name')->nullable(); // Add this line to create the vendor_name column
        $table->decimal('rating', 2, 1);
        $table->text('description')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
