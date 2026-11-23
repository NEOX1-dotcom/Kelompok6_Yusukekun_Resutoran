<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('karyawan', function (Blueprint $table) {
            $table->id('id_karyawan');
            $table->foreignId('id_cabang')
                ->constrained('cabang', 'id_cabang')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('nama_karyawan', 100);
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('karyawan');
    }
};
