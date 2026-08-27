<?php

namespace Database\Seeders;

use App\Models\MonitoringResponse;
use Illuminate\Database\Seeder;

class MonitoringResponseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $samples = [
            [
                'email_address'             => 'operator.maos1@pertamina.com',
                'tanggal'                   => '2026-08-25',
                'lokasi'                    => 'FT Maos - Tangki 1',
                'stok_awal_mm'              => 4250.0,
                'volume_stok_awal_l'        => 350000.0,
                'density_awal_penyaluran'   => 0.745,
                'temperature_c'             => 28.5,
                'jam_antar_penyaluran'      => '08:00 - 12:00',
                'stok_akhir_mm'             => 3100.0,
                'volume_akhir_l'            => 255000.0,
                'density_akhir'             => 0.746,
                'volume_akhir_penyaluran_l' => 95000.0,
                'stok_tangki_1_l'           => 255000.0,
                'stok_tangki_2_l'           => 310000.0,
            ],
            [
                'email_address'             => 'supervisor.ftmaos@pertamina.com',
                'tanggal'                   => '2026-08-26',
                'lokasi'                    => 'FT Maos - Tangki 2',
                'stok_awal_mm'              => 5100.0,
                'volume_stok_awal_l'        => 420000.0,
                'density_awal_penyaluran'   => 0.742,
                'temperature_c'             => 29.0,
                'jam_antar_penyaluran'      => '13:00 - 17:00',
                'stok_akhir_mm'             => 3900.0,
                'volume_akhir_l'            => 320000.0,
                'density_akhir'             => 0.743,
                'volume_akhir_penyaluran_l' => 100000.0,
                'stok_tangki_1_l'           => 320000.0,
                'stok_tangki_2_l'           => 400000.0,
            ],
            [
                'email_address'             => 'petugas.penyaluran@pertamina.com',
                'tanggal'                   => '2026-08-27',
                'lokasi'                    => 'FT Maos - Filling Shed',
                'stok_awal_mm'              => 3800.0,
                'volume_stok_awal_l'        => 310000.0,
                'density_awal_penyaluran'   => 0.748,
                'temperature_c'             => 27.8,
                'jam_antar_penyaluran'      => '07:30 - 11:30',
                'stok_akhir_mm'             => 2600.0,
                'volume_akhir_l'            => 210000.0,
                'density_akhir'             => 0.747,
                'volume_akhir_penyaluran_l' => 100000.0,
                'stok_tangki_1_l'           => 210000.0,
                'stok_tangki_2_l'           => 280000.0,
            ],
        ];

        foreach ($samples as $sample) {
            MonitoringResponse::create($sample);
        }
    }
}
