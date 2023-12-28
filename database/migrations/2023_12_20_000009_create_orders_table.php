<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('outlet_id');
            $table->foreignId('category_id');
            $table->foreignId('delivery_option_id');
            $table->foreignId('transaction_id');
            $table->string('document_file');
            $table->integer('quantity');
            $table->float('total_price');
            $table->integer('point');
            $table->enum('status', [
                'pending',
                'ordered',
                'prepared',
                'picked up',
                'completed',
            ])->default('pending');
            $table->text('qr_code');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
