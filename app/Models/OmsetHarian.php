<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OmsetHarian extends Model
{
    use HasFactory;

    protected $table = 'omset_harian';
    protected $primaryKey = 'id_omset_harian';

    protected $fillable = [
        'id_omset_bulanan',
        'tanggal',
        'total_transaksi',
        'total_item_terjual',
        'total_omset',
        'metode_tunai',
        'metode_non_tunai',
        'keterangan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'total_item_terjual' => 'decimal:2',
            'total_omset' => 'decimal:2',
            'metode_tunai' => 'decimal:2',
            'metode_non_tunai' => 'decimal:2',
        ];
    }

    /**
     * Relasi ke Rekap Omset Bulanan
     */
    public function omsetBulanan(): BelongsTo
    {
        return $this->belongsTo(OmsetBulanan::class, 'id_omset_bulanan', 'id_omset_bulanan');
    }

    /**
     * Relasi ke transaksi Penjualan di hari ini
     */
    public function penjualan(): HasMany
    {
        return $this->hasMany(Penjualan::class, 'id_omset_harian', 'id_omset_harian');
    }

    /**
     * Hitung & sinkronisasi rekap omset harian dari data transaksi penjualan
     */
    public static function syncForDate(string $tanggal): self
    {
        $bulan = Carbon::parse($tanggal)->format('Y-m');

        // Pastikan record rekap bulanan sudah ada
        $omsetBulanan = OmsetBulanan::firstOrCreate(
            ['bulan' => $bulan],
            [
                'total_hari' => 0,
                'total_transaksi' => 0,
                'total_item_terjual' => 0,
                'total_omset' => 0,
                'rata_rata_harian' => 0,
            ]
        );

        $penjualanQuery = Penjualan::whereDate('tanggal', $tanggal);

        $totalTransaksi = (int) $penjualanQuery->count();
        $totalItem = (float) $penjualanQuery->sum('jumlah_terjual');
        $totalOmset = (float) $penjualanQuery->sum('total');

        $metodeTunai = (float) (clone $penjualanQuery)
            ->where('metode_pembayaran', 'Tunai')
            ->sum('total');

        $metodeNonTunai = (float) (clone $penjualanQuery)
            ->where('metode_pembayaran', '!=', 'Tunai')
            ->sum('total');

        $omsetHarian = static::updateOrCreate(
            ['tanggal' => Carbon::parse($tanggal)->format('Y-m-d')],
            [
                'id_omset_bulanan' => $omsetBulanan->id_omset_bulanan,
                'total_transaksi' => $totalTransaksi,
                'total_item_terjual' => $totalItem,
                'total_omset' => $totalOmset,
                'metode_tunai' => $metodeTunai,
                'metode_non_tunai' => $metodeNonUntunai = $metodeNonTunai,
            ]
        );

        // Hubungkan semua record penjualan di tanggal tsb ke id_omset_harian ini
        Penjualan::whereDate('tanggal', $tanggal)
            ->update(['id_omset_harian' => $omsetHarian->id_omset_harian]);

        // Perbarui rekap bulanan induk
        OmsetBulanan::syncForMonth($bulan);

        return $omsetHarian;
    }
}
