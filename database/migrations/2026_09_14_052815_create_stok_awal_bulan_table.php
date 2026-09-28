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
        Schema::create('stok_awal_bulan', function (Blueprint $table) {
            $table->id('id_stok_awal');
            $table->char('bulan', 7); // Format: YYYY-MM
            $table->foreignId('id_bahan')->constrained('bahan', 'id_bahan')->cascadeOnUpdate()->cascadeOnDelete();
            $table->decimal('stok_awal', 15, 2)->default(0);
            $table->timestamps();

            $table->unique(['bulan', 'id_bahan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_awal_bulan');
    }
};
