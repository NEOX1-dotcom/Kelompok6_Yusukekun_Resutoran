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
        Schema::create('omset_bulanan', function (Blueprint $table) {
            $table->id('id_omset_bulanan');
            $table->char('bulan', 7)->unique(); // Format: YYYY-MM
            $table->integer('total_hari')->default(0);
            $table->integer('total_transaksi')->default(0);
            $table->decimal('total_item_terjual', 15, 2)->default(0);
            $table->decimal('total_omset', 15, 2)->default(0);
            $table->decimal('rata_rata_harian', 15, 2)->default(0);
            $table->string('keterangan', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('omset_bulanan');
    }
};
