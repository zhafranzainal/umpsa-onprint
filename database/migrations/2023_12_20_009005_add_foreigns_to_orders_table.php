<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table
                ->foreign('outlet_id')
                ->references('id')
                ->on('outlets')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('package_id')
                ->references('id')
                ->on('packages')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('delivery_option_id')
                ->references('id')
                ->on('delivery_options')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('transaction_id')
                ->references('id')
                ->on('transactions')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['outlet_id']);
            $table->dropForeign(['package_id']);
            $table->dropForeign(['delivery_option_id']);
            $table->dropForeign(['transaction_id']);
        });
    }
};
