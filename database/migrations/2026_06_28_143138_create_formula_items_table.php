<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('formula_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('feed_formula_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('raw_material_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->decimal('quantity_required', 10, 2);
            $table->string('unit');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('formula_items');
    }
};