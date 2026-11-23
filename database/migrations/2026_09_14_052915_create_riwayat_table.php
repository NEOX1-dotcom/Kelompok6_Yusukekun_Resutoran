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
        Schema::create('riwayat', function (Blueprint $table) {
            $table->id('id_riwayat');
            $table->foreignId('id_omset')->nullable()->constrained('omset', 'id_omset')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('id_cabang')->constrained('cabang', 'id_cabang')->cascadeOnUpdate()->cascadeOnDelete();
            $table->date('tanggal');
            $table->string('kode_transaksi', 20)->nullable();
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
        Schema::dropIfExists('riwayat');
    }
};
