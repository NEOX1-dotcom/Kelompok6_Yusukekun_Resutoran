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
        Schema::create('bahan_keluar', function (Blueprint $table) {
             $table->id('id_keluar');
            $table->date('tanggal');
            $table->foreignId('id_bahan')->constrained('bahan', 'id_bahan')->cascadeOnUpdate();
            $table->decimal('jumlah', 15, 2);
            $table->string('digunakan_untuk', 100)->nullable();
            $table->string('keterangan', 255)->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bahan_keluar');
    }
};
