<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('batch_settings', function (Blueprint $table) {
            $table->id();
            $table->string('setting_name');
            $table->decimal('batch_size_kg', 10, 2);
            $table->integer('sacks_equivalent');
            $table->text('notes')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('batch_settings');
    }
};