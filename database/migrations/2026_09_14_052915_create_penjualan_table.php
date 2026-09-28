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
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id('id_penjualan');
            $table->foreignId('id_omset_harian')->nullable()->constrained('omset_harian', 'id_omset_harian')->cascadeOnUpdate()->nullOnDelete();
            $table->date('tanggal');
            $table->foreignId('id_produk')->constrained('produk', 'id_produk')->cascadeOnUpdate()->cascadeOnDelete();
            $table->decimal('jumlah_terjual', 15, 2);
            $table->decimal('harga_satuan', 15, 2)->default(0);
            $table->decimal('total', 15, 2)->default(0);
            $table->enum('metode_pembayaran', ['Tunai', 'QRIS', 'Transfer', 'Kartu Debit/Kredit', 'Lainnya'])->default('Tunai');
            $table->string('keterangan', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan');
    }
};
