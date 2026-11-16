<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Omset extends Model
{
    use HasFactory;

    protected $table = 'omset';
    protected $primaryKey = 'id_omset';

    protected $fillable = [
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

    public function penjualan(): HasMany
    {
        return $this->hasMany(Penjualan::class, 'id_omset', 'id_omset');
    }

    public static function syncForDate(string $tanggal): self
    {
        $tanggal = Carbon::parse($tanggal)->format('Y-m-d');
        $penjualanQuery = Penjualan::whereDate('tanggal', $tanggal);

        $metodeTunai = (float) (clone $penjualanQuery)
            ->where('metode_pembayaran', 'Tunai')
            ->sum('total');

        $metodeNonTunai = (float) (clone $penjualanQuery)
            ->where('metode_pembayaran', '!=', 'Tunai')
            ->sum('total');

        $omset = static::updateOrCreate(
            ['tanggal' => $tanggal],
            [
                'total_transaksi' => (int) (clone $penjualanQuery)->count(),
                'total_item_terjual' => (float) (clone $penjualanQuery)->sum('jumlah_terjual'),
                'total_omset' => (float) (clone $penjualanQuery)->sum('total'),
                'metode_tunai' => $metodeTunai,
                'metode_non_tunai' => $metodeNonTunai,
            ]
        );

        $penjualanQuery->update(['id_omset' => $omset->id_omset]);

        return $omset;
    }
}
