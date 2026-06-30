<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('production_batches', function (Blueprint $table) {
            $table->id();
            $table->string('batch_number')->unique();
            $table->foreignId('feed_product_id')
                ->constrained();
            $table->foreignId('feed_formula_id')
                ->constrained();
            $table->foreignId('batch_setting_id')
                ->nullable()
                ->constrained();
            $table->date('production_date');
            $table->decimal('quantity_kg', 10, 2);
            $table->integer('sacks_produced');
            $table->decimal('total_raw_material_used', 10, 2);
            $table->string('status');
            $table->foreignId('encoded_by')
                ->nullable()
                ->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('production_batches');
    }
};