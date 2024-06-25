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
            $table->string('sku')->unique();
            $table->string('symbology')->nullable();
            $table->foreignId('brand_id')->constrained('brands');
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('unit_id')->constrained('units');
            $table->decimal('price', 10, 2);
            $table->integer('qty');
            $table->integer('alert_qty')->nullable();
            $table->string('tax_method')->nullable();
            $table->foreignId('tax_id')->constrained('taxes');
            $table->boolean('has_stock')->default(true);
            $table->boolean('has_expired_date')->default(false);
            $table->date('expired_date')->nullable();
            $table->text('details')->nullable();
            $table->boolean('is_active')->default(true);
            $table->softDeletes(); // Soft delete column
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
