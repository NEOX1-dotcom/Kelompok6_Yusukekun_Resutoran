<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OmsetBulanan extends Model
{
    use HasFactory;

    protected $table = 'omset_bulanan';
    protected $primaryKey = 'id_omset_bulanan';

    protected $fillable = [
        'bulan',
        'total_hari',
        'total_transaksi',
        'total_item_terjual',
        'total_omset',
        'rata_rata_harian',
        'keterangan',
    ];

    protected function casts(): array
    {
        return [
            'total_item_terjual' => 'decimal:2',
            'total_omset' => 'decimal:2',
            'rata_rata_harian' => 'decimal:2',
        ];
    }

    /**
     * Relasi ke data Omset Harian di bulan ini
     */
    public function omsetHarian(): HasMany
    {
        return $this->hasMany(OmsetHarian::class, 'id_omset_bulanan', 'id_omset_bulanan');
    }

    /**
     * Hitung & sinkronisasi rekap omset bulanan dari data omset harian
     */
    public static function syncForMonth(string $bulan): self
    {
        $harianQuery = OmsetHarian::where('tanggal', 'like', "{$bulan}%");

        $totalHari = (int) $harianQuery->count();
        $totalTransaksi = (int) $harianQuery->sum('total_transaksi');
        $totalItem = (float) $harianQuery->sum('total_item_terjual');
        $totalOmset = (float) $harianQuery->sum('total_omset');
        $rataRata = $totalHari > 0 ? ($totalOmset / $totalHari) : 0;

        $omsetBulanan = static::updateOrCreate(
            ['bulan' => $bulan],
            [
                'total_hari' => $totalHari,
                'total_transaksi' => $totalTransaksi,
                'total_item_terjual' => $totalItem,
                'total_omset' => $totalOmset,
                'rata_rata_harian' => $rataRata,
            ]
        );

        // Pastikan semua record omset_harian di bulan ini terhubung ke id_omset_bulanan ini
        OmsetHarian::where('tanggal', 'like', "{$bulan}%")
            ->whereNull('id_omset_bulanan')
            ->update(['id_omset_bulanan' => $omsetBulanan->id_omset_bulanan]);

        return $omsetBulanan;
    }
}
