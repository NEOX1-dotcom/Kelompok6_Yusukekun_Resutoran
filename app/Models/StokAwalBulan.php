<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StokAwalBulan extends Model
{
    use HasFactory;

    protected $table = 'stok_awal_bulan';
    protected $primaryKey = 'id_stok_awal';

    protected $fillable = [
        'bulan',
        'id_bahan',
        'stok_awal',
    ];

    protected function casts(): array
    {
        return [
            'stok_awal' => 'decimal:2',
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
