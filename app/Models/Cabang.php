<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cabang extends Model
{
    use HasFactory;

    protected $table = 'cabang';
    protected $primaryKey = 'id_cabang';

    protected $fillable = [
        'nama_cabang',
        'anggota1',
        'anggota2',
        'anggota3',
        'alamat',
        'no_telp',
    ];

    public function omset(): HasMany
    {
        return $this->hasMany(Omset::class, 'id_cabang', 'id_cabang');
    }

    public function karyawan(): HasMany
    {
        return $this->hasMany(Karyawan::class, 'id_cabang', 'id_cabang');
    }
}
