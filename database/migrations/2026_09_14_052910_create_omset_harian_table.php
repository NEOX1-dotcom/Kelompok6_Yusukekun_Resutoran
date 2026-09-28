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
        Schema::create('omset_harian', function (Blueprint $table) {
            $table->id('id_omset_harian');
            $table->foreignId('id_omset_bulanan')->nullable()->constrained('omset_bulanan', 'id_omset_bulanan')->cascadeOnUpdate()->nullOnDelete();
            $table->date('tanggal')->unique();
            $table->integer('total_transaksi')->default(0);
            $table->decimal('total_item_terjual', 15, 2)->default(0);
            $table->decimal('total_omset', 15, 2)->default(0);
            $table->decimal('metode_tunai', 15, 2)->default(0);
            $table->decimal('metode_non_tunai', 15, 2)->default(0);
            $table->string('keterangan', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('omset_harian');
    }
};
