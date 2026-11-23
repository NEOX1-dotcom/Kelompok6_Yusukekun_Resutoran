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
        if (Schema::hasTable('omset')) {
            foreach (Schema::getForeignKeys('omset') as $foreignKey) {
                if ($foreignKey['columns'] === ['id_cabang'] && $foreignKey['foreign_table'] === 'cabang') {
                    return;
                }
            }

            Schema::table('omset', function (Blueprint $table) {
                $table->foreign('id_cabang')
                    ->references('id_cabang')
                    ->on('cabang')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            });

            return;
        }

        Schema::create('omset', function (Blueprint $table) {
            $table->id('id_omset');
            $table->date('tanggal')->unique();
            $table->foreignId('id_cabang')->constrained('cabang', 'id_cabang')->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('omset');
    }
};
