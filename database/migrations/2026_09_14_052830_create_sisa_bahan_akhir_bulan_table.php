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
        Schema::create('sisa_bahan_akhir_bulan', function (Blueprint $table) {
            $table->id('id_sisa_akhir');
            $table->char('bulan', 7); // Format: YYYY-MM
            $table->foreignId('id_bahan')->constrained('bahan', 'id_bahan')->cascadeOnUpdate()->cascadeOnDelete();
            $table->decimal('stok_awal', 15, 2)->default(0);
            $table->decimal('total_masuk', 15, 2)->default(0);
            $table->decimal('total_keluar', 15, 2)->default(0);
            $table->decimal('sisa_akhir', 15, 2)->default(0);
            $table->string('keterangan', 255)->nullable();
            $table->timestamps();

            $table->unique(['bulan', 'id_bahan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sisa_bahan_akhir_bulan');
    }
};
