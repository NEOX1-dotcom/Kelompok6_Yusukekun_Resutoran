<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BahanMasuk extends Model
{
    use HasFactory;

    protected $table = 'bahan_masuk';
    protected $primaryKey = 'id_masuk';

    protected $fillable = [
        'tanggal',
        'id_bahan',
        'jumlah',
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
