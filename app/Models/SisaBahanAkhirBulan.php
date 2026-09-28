<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SisaBahanAkhirBulan extends Model
{
    use HasFactory;

    protected $table = 'sisa_bahan_akhir_bulan';
    protected $primaryKey = 'id_sisa_akhir';

    protected $fillable = [
        'bulan',
        'id_bahan',
        'stok_awal',
        'total_masuk',
        'total_keluar',
        'sisa_akhir',
        'keterangan',
    ];

    protected function casts(): array
    {
        return [
            'stok_awal' => 'decimal:2',
            'total_masuk' => 'decimal:2',
            'total_keluar' => 'decimal:2',
            'sisa_akhir' => 'decimal:2',
        ];
    }

    /**
     * Relasi ke Bahan
     */
    public function bahan(): BelongsTo
    {
        return $this->belongsTo(Bahan::class, 'id_bahan', 'id_bahan');
    }

    /**
     * Hitung & sinkronisasi sisa bahan akhir bulan untuk satu bahan spesifik
     */
    public static function syncForMonthAndBahan(string $bulan, int $idBahan): self
    {
        $parsedDate = Carbon::createFromFormat('Y-m', $bulan);
        $year = $parsedDate->year;
        $month = $parsedDate->month;

        $stokAwal = (float) (StokAwalBulan::where('bulan', $bulan)
            ->where('id_bahan', $idBahan)
            ->value('stok_awal') ?? 0);

        $totalMasuk = (float) (BahanMasuk::where('id_bahan', $idBahan)
            ->whereYear('tanggal', $year)
            ->whereMonth('tanggal', $month)
            ->sum('jumlah') ?? 0);

        $totalKeluar = (float) (BahanKeluar::where('id_bahan', $idBahan)
            ->whereYear('tanggal', $year)
            ->whereMonth('tanggal', $month)
            ->sum('jumlah') ?? 0);

        $sisaAkhir = $stokAwal + $totalMasuk - $totalKeluar;

        return static::updateOrCreate(
            ['bulan' => $bulan, 'id_bahan' => $idBahan],
            [
                'stok_awal' => $stokAwal,
                'total_masuk' => $totalMasuk,
                'total_keluar' => $totalKeluar,
                'sisa_akhir' => $sisaAkhir,
            ]
        );
    }

    /**
     * Hitung & sinkronisasi sisa bahan akhir bulan untuk seluruh bahan baku di bulan tsb
     */
    public static function syncForMonth(string $bulan): Collection
    {
        $allBahan = Bahan::all();
        $results = new Collection();

        foreach ($allBahan as $bahan) {
            $results->push(static::syncForMonthAndBahan($bulan, $bahan->id_bahan));
        }

        return $results;
    }
}
