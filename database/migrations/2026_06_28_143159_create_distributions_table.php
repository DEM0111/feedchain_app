<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('distributions', function (Blueprint $table) {
            $table->id();
            $table->string('distribution_number');
            $table->foreignId('buyer_id')
                ->constrained('buyers')
                ->cascadeOnDelete();
            $table->date('distribution_date');
            $table->decimal('total_quantity', 10, 2);
            $table->text('remarks')->nullable();
            $table->string('status');
            $table->foreignId('encoded_by')
                ->nullable()
                ->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('distributions');
    }
};