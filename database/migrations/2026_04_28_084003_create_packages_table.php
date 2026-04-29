<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('packages', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->enum('discount_type', ['flat', 'percent'])->nullable();
        $table->decimal('value', 10, 2)->nullable(); // discount value
        // $table->decimal('final_price', 10, 2)->nullable(); // optional manual price
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
