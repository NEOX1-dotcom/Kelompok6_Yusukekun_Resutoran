<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    protected $primaryKey = 'id_produk';

    protected $fillable = [
        'nama_produk',
        'kategori',
        'harga',
        'stok',
    ];

    protected function casts(): array
    {
        return [
            'harga' => 'decimal:2',
            'stok' => 'decimal:2',
        ];
    }

    /**
     * Relasi ke transaksi penjualan
     */
    public function penjualan(): HasMany
    {
        return $this->hasMany(Penjualan::class, 'id_produk', 'id_produk');
    }
}
