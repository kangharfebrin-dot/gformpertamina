<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('monitoring_responses', function (Blueprint $table) {
            $table->id();
            $table->string('email_address');
            $table->date('tanggal');
            $table->string('lokasi');
            $table->double('stok_awal_mm')->nullable();
            $table->double('volume_stok_awal_l')->nullable();
            $table->double('density_awal_penyaluran')->nullable();
            $table->double('temperature_c')->nullable();
            $table->string('jam_antar_penyaluran')->nullable();
            $table->double('stok_akhir_mm')->nullable();
            $table->double('volume_akhir_l')->nullable();
            $table->double('density_akhir')->nullable();
            $table->double('volume_akhir_penyaluran_l')->nullable();
            $table->double('stok_tangki_1_l')->nullable();
            $table->double('stok_tangki_2_l')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitoring_responses');
    }
};
