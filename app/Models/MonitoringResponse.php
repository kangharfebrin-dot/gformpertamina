<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonitoringResponse extends Model
{
    protected $fillable = [
        'email_address',
        'tanggal',
        'lokasi',
        'stok_awal_mm',
        'volume_stok_awal_l',
        'density_awal_penyaluran',
        'temperature_c',
        'jam_antar_penyaluran',
        'stok_akhir_mm',
        'volume_akhir_l',
        'density_akhir',
        'volume_akhir_penyaluran_l',
        'stok_tangki_1_l',
        'stok_tangki_2_l',
    ];
}
