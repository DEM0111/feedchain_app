<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stock_alerts', function (Blueprint $table) {
            $table->id();
            $table->string('inventory_type');
            $table->foreignId('raw_material_id')
                ->nullable()
                ->constrained();
            $table->foreignId('feed_product_id')
                ->nullable()
                ->constrained();
            $table->decimal('current_quantity', 10, 2);
            $table->decimal('threshold_quantity', 10, 2);
            $table->string('alert_level');
            $table->text('alert_message');
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_alerts');
    }
};