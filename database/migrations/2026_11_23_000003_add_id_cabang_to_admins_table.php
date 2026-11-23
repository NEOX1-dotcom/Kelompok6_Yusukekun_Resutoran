<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->foreignId('id_cabang')
                ->nullable()
                ->constrained('cabang', 'id_cabang')
                ->nullOnDelete()
                ->cascadeOnUpdate();
        });

        $idCabangPertama = DB::table('cabang')->orderBy('id_cabang')->value('id_cabang');

        if ($idCabangPertama !== null) {
            DB::table('admins')
                ->whereNull('id_cabang')
                ->update(['id_cabang' => $idCabangPertama]);
        }
    }

    public function down(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropConstrainedForeignId('id_cabang');
        });
    }
};
