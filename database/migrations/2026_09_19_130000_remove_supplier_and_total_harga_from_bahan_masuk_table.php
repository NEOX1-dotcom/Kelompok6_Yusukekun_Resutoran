<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bahan_masuk', function (Blueprint $table) {
            $table->dropColumn(['id_supplier', 'total_harga']);
        });
    }

    public function down(): void
    {
        Schema::table('bahan_masuk', function (Blueprint $table) {
            $table->foreignId('id_supplier');
            $table->decimal('total_harga', 15, 2)->default(0);
        });
    }
};