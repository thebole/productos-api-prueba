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
            $table->string('name', 150);
            $table->text('description')->nullable();

            $table->unsignedDecimal('price', 12, 2);
            $table->unsignedDecimal('tax_cost', 12, 2)->default(0);
            $table->unsignedDecimal('manufacturing_cost', 12, 2)->default(0);

            $table->foreignId('divisa_id')
                ->constrained('divisas')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

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
