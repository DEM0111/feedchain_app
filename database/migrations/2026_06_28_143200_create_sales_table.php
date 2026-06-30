<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('sales_number');
            $table->foreignId('customer_id')
                ->constrained('customers');
            $table->date('sales_date');
            $table->decimal('total_amount', 10, 2);
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
        Schema::dropIfExists('sales');
    }
};