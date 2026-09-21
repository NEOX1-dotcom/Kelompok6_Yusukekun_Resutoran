<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'supplier';
    protected $primaryKey = 'id_supplier';

    protected $fillable = [
        'nama_supplier',
        'kontak',
        'alamat',
        'no_telp',
    ];

    /**
     * Relasi ke transaksi bahan masuk
     */
    public function bahanMasuk(): HasMany
    {
        return $this->hasMany(BahanMasuk::class, 'id_supplier', 'id_supplier');
    }
}
