<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('bahan', 'satuan')) {
            Schema::table('bahan', function (Blueprint $table) {
                $table->dropColumn('satuan');
            });
        }
    }

    public function down(): void
    {
        if (! Schema::hasColumn('bahan', 'satuan')) {
            Schema::table('bahan', function (Blueprint $table) {
                $table->string('satuan', 50)->default('-')->after('kategori');
            });
        }
    }
};
