<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bahan extends Model
{
    use HasFactory;

    protected $table = 'bahan';
    protected $primaryKey = 'id_bahan';

    protected $fillable = [
        'nama_bahan',
        'kategori',
        'satuan',
    ];

    /**
     * Relasi ke transaksi bahan masuk
     */
    public function bahanMasuk(): HasMany
    {
        return $this->hasMany(BahanMasuk::class, 'id_bahan', 'id_bahan');
    }

    /**
     * Relasi ke transaksi bahan keluar
     */
    public function bahanKeluar(): HasMany
    {
        return $this->hasMany(BahanKeluar::class, 'id_bahan', 'id_bahan');
    }

    /**
     * Relasi ke pencatatan stok awal bulan
     */
    public function stokAwalBulan(): HasMany
    {
        return $this->hasMany(StokAwalBulan::class, 'id_bahan', 'id_bahan');
    }
}
