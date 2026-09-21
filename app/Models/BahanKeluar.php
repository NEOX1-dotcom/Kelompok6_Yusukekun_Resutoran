<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BahanKeluar extends Model
{
    use HasFactory;

    protected $table = 'bahan_keluar';
    protected $primaryKey = 'id_keluar';

    protected $fillable = [
        'tanggal',
        'id_bahan',
        'jumlah',
        'digunakan_untuk',
        'keterangan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'jumlah' => 'decimal:2',
        ];
    }

    /**
     * Relasi ke Bahan
     */
    public function bahan(): BelongsTo
    {
        return $this->belongsTo(Bahan::class, 'id_bahan', 'id_bahan');
    }
}
