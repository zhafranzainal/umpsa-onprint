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
        Schema::table('inventory_outlet', function (Blueprint $table) {
            $table
                ->foreign('outlet_id')
                ->references('id')
                ->on('outlets')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('inventory_id')
                ->references('id')
                ->on('inventories')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inventory_outlet', function (Blueprint $table) {
            $table->dropForeign(['outlet_id']);
            $table->dropForeign(['inventory_id']);
        });
    }
};
