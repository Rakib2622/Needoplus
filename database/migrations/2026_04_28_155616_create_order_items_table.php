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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();

            // 🔗 ORDER RELATION
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();

            // 📦 PRODUCT OR PACKAGE (one of them will be filled)
            $table->foreignId('product_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('package_id')->nullable()->constrained()->nullOnDelete();

            // 📝 SNAPSHOT DATA (VERY IMPORTANT)
            $table->string('name');
            $table->string('color')->nullable(); // product/package color at purchase time
            $table->decimal('price', 10, 2); // final price at purchase time
            $table->integer('quantity');
            $table->decimal('subtotal', 10, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
