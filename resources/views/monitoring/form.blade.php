@extends('layouts.app')

@section('title', 'Monitoring Penyaluran & Stok - Pertamina Patra Niaga FT Maos')

@section('content')
<form action="{{ route('monitoring.store') }}" method="POST" id="monitoringForm">
    @csrf

    <!-- Header Banner & Title Card -->
    <div class="gf-card gf-header-card">
        <img src="{{ asset('images/banner.png') }}" alt="Pertamina Patra Niaga Maos" class="gf-header-banner">
        <div class="gf-header-content">
            <div class="gf-form-badge">
                <i class="fa-solid fa-building-shield" style="color: var(--pertamina-red);"></i> Pertamina Patra Niaga &bull; FT Maos
            </div>
            <h1 class="gf-form-title">Monitoring Penyaluran & Stok</h1>
            <p class="gf-form-subtitle">Formulir Perekaman Data Operasional Penyaluran BBM & Monitoring Stok Tangki Fuel Terminal Maos.</p>
            
            <div class="gf-divider"></div>

            <div style="margin-bottom: 12px;">
                <label class="gf-question-title" for="email_address">
                    Email Address <span class="gf-required-star">*</span>
                </label>
                <input type="email" name="email_address" id="email_address" class="gf-input-text gf-input-full" placeholder="email.anda@pertamina.com" value="{{ old('email_address') }}" required>
                @error('email_address')
                    <div class="gf-alert-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="gf-required-note">* Menunjukkan pertanyaan yang wajib diisi</div>
        </div>
    </div>

    <!-- SECTION 1: INFORMASI UMUM -->
    <div class="gf-card gf-section-card">
        <div class="gf-section-title"><i class="fa-regular fa-calendar-check"></i> Bagian 1: Informasi Tanggal & Lokasi</div>
        <div class="gf-section-subtitle">Masukkan parameter tanggal dan area lokasi operasional.</div>
    </div>

    <!-- Tanggal -->
    <div class="gf-card">
        <label class="gf-question-title" for="tanggal">
            Tanggal <span class="gf-required-star">*</span>
        </label>
        <div class="gf-question-desc">Pilih tanggal pengukuran data penyaluran.</div>
        <input type="date" name="tanggal" id="tanggal" class="gf-input-text" value="{{ old('tanggal', date('Y-m-d')) }}" required>
        @error('tanggal')
            <div class="gf-alert-error">{{ $message }}</div>
        @enderror
    </div>

    <!-- Lokasi -->
    <div class="gf-card">
        <label class="gf-question-title">
            Lokasi <span class="gf-required-star">*</span>
        </label>
        <div style="margin-top: 14px; display: flex; flex-direction: column; gap: 14px;">
            <label style="display: flex; align-items: center; gap: 12px; cursor: pointer; font-size: 14px; color: #202124;">
                <input type="radio" name="lokasi" value="Cilacap" {{ old('lokasi') == 'Cilacap' ? 'checked' : '' }} style="accent-color: var(--pertamina-blue); width: 18px; height: 18px;" required>
                <span>1. Cilacap</span>
            </label>
            <label style="display: flex; align-items: center; gap: 12px; cursor: pointer; font-size: 14px; color: #202124;">
                <input type="radio" name="lokasi" value="Kroya" {{ old('lokasi') == 'Kroya' ? 'checked' : '' }} style="accent-color: var(--pertamina-blue); width: 18px; height: 18px;">
                <span>2. Kroya</span>
            </label>
            <label style="display: flex; align-items: center; gap: 12px; cursor: pointer; font-size: 14px; color: #202124;">
                <input type="radio" name="lokasi" value="Purwokerto" {{ old('lokasi') == 'Purwokerto' ? 'checked' : '' }} style="accent-color: var(--pertamina-blue); width: 18px; height: 18px;">
                <span>3. Purwokerto</span>
            </label>
        </div>
        @error('lokasi')
            <div class="gf-alert-error">{{ $message }}</div>
        @enderror
    </div>

    <!-- SECTION 2: DATA AWAL PENYALURAN -->
    <div class="gf-card gf-section-card">
        <div class="gf-section-title"><i class="fa-solid fa-gauge-high"></i> Bagian 2: Parameter Stok & Penyaluran Awal</div>
        <div class="gf-section-subtitle">Data awal sebelum penyaluran BBM dimulai.</div>
    </div>

    <!-- Stok Awal (MM) -->
    <div class="gf-card">
        <label class="gf-question-title" for="stok_awal_mm">
            Stok Awal (MM)
        </label>
        <div class="gf-question-desc">Ketinggian stok awal tangki dalam milimeter (MM).</div>
        <input type="number" step="any" name="stok_awal_mm" id="stok_awal_mm" class="gf-input-text" placeholder="Jawaban Anda" value="{{ old('stok_awal_mm') }}">
        @error('stok_awal_mm')
            <div class="gf-alert-error">{{ $message }}</div>
        @enderror
    </div>

    <!-- Volume Stok Awal (L) -->
    <div class="gf-card">
        <label class="gf-question-title" for="volume_stok_awal_l">
            Volume Stok Awal (L)
        </label>
        <div class="gf-question-desc">Total volume awal tangki dalam Liter (L).</div>
        <input type="number" step="any" name="volume_stok_awal_l" id="volume_stok_awal_l" class="gf-input-text" placeholder="Jawaban Anda" value="{{ old('volume_stok_awal_l') }}">
        @error('volume_stok_awal_l')
            <div class="gf-alert-error">{{ $message }}</div>
        @enderror
    </div>

    <!-- Density Awal Penyaluran -->
    <div class="gf-card">
        <label class="gf-question-title" for="density_awal_penyaluran">
            Density Awal Penyaluran
        </label>
        <div class="gf-question-desc">Nilai massa jenis (density) BBM sebelum penyaluran (kg/m³).</div>
        <input type="number" step="any" name="density_awal_penyaluran" id="density_awal_penyaluran" class="gf-input-text" placeholder="Jawaban Anda" value="{{ old('density_awal_penyaluran') }}">
        @error('density_awal_penyaluran')
            <div class="gf-alert-error">{{ $message }}</div>
        @enderror
    </div>

    <!-- Temperature (°C) -->
    <div class="gf-card">
        <label class="gf-question-title" for="temperature_c">
            Temperature (°C)
        </label>
        <div class="gf-question-desc">Suhu BBM saat pengukuran dalam derajat Celcius.</div>
        <input type="number" step="any" name="temperature_c" id="temperature_c" class="gf-input-text" placeholder="Jawaban Anda" value="{{ old('temperature_c') }}">
        @error('temperature_c')
            <div class="gf-alert-error">{{ $message }}</div>
        @enderror
    </div>

    <!-- Jam Antar Penyaluran (Jam) -->
    <div class="gf-card">
        <label class="gf-question-title" for="jam_antar_penyaluran">
            Jam Antar Penyaluran (Jam)
        </label>
        <div class="gf-question-desc">Durasi atau interval jam penyaluran.</div>
        <input type="text" name="jam_antar_penyaluran" id="jam_antar_penyaluran" class="gf-input-text" placeholder="Contoh: 08:00 - 12:00 / 4 Jam" value="{{ old('jam_antar_penyaluran') }}">
        @error('jam_antar_penyaluran')
            <div class="gf-alert-error">{{ $message }}</div>
        @enderror
    </div>

    <!-- SECTION 3: DATA AKHIR PENYALURAN & STOK TANGKI -->
    <div class="gf-card gf-section-card">
        <div class="gf-section-title"><i class="fa-solid fa-chart-line"></i> Bagian 3: Parameter Stok & Penyaluran Akhir</div>
        <div class="gf-section-subtitle">Perekaman hasil akhir penyaluran & kondisi stok fisik tangki.</div>
    </div>

    <!-- Stok Akhir (MM) -->
    <div class="gf-card">
        <label class="gf-question-title" for="stok_akhir_mm">
            Stok Akhir (MM)
        </label>
        <div class="gf-question-desc">Ketinggian stok akhir tangki dalam milimeter (MM).</div>
        <input type="number" step="any" name="stok_akhir_mm" id="stok_akhir_mm" class="gf-input-text" placeholder="Jawaban Anda" value="{{ old('stok_akhir_mm') }}">
        @error('stok_akhir_mm')
            <div class="gf-alert-error">{{ $message }}</div>
        @enderror
    </div>

    <!-- Volume Akhir (L) -->
    <div class="gf-card">
        <label class="gf-question-title" for="volume_akhir_l">
            Volume Akhir (L)
        </label>
        <div class="gf-question-desc">Total volume akhir tangki dalam Liter (L).</div>
        <input type="number" step="any" name="volume_akhir_l" id="volume_akhir_l" class="gf-input-text" placeholder="Jawaban Anda" value="{{ old('volume_akhir_l') }}">
        @error('volume_akhir_l')
            <div class="gf-alert-error">{{ $message }}</div>
        @enderror
    </div>

    <!-- Density Akhir -->
    <div class="gf-card">
        <label class="gf-question-title" for="density_akhir">
            Density Akhir
        </label>
        <div class="gf-question-desc">Nilai massa jenis (density) BBM setelah penyaluran.</div>
        <input type="number" step="any" name="density_akhir" id="density_akhir" class="gf-input-text" placeholder="Jawaban Anda" value="{{ old('density_akhir') }}">
        @error('density_akhir')
            <div class="gf-alert-error">{{ $message }}</div>
        @enderror
    </div>

    <!-- Volume Akhir Penyaluran (L) -->
    <div class="gf-card">
        <label class="gf-question-title" for="volume_akhir_penyaluran_l">
            Volume Akhir Penyaluran (L)
        </label>
        <div class="gf-question-desc">Akumulasi total volume BBM yang tersalurkan (Liter).</div>
        <input type="number" step="any" name="volume_akhir_penyaluran_l" id="volume_akhir_penyaluran_l" class="gf-input-text" placeholder="Jawaban Anda" value="{{ old('volume_akhir_penyaluran_l') }}">
        @error('volume_akhir_penyaluran_l')
            <div class="gf-alert-error">{{ $message }}</div>
        @enderror
    </div>

    <!-- Stok Tangki 1 (L) -->
    <div class="gf-card">
        <label class="gf-question-title" for="stok_tangki_1_l">
            Stok Tangki 1 (L)
        </label>
        <div class="gf-question-desc">Sisa stok aktual Tangki 1 dalam Liter (L).</div>
        <input type="number" step="any" name="stok_tangki_1_l" id="stok_tangki_1_l" class="gf-input-text" placeholder="Jawaban Anda" value="{{ old('stok_tangki_1_l') }}">
        @error('stok_tangki_1_l')
            <div class="gf-alert-error">{{ $message }}</div>
        @enderror
    </div>

    <!-- Stok Tangki 2 (L) -->
    <div class="gf-card">
        <label class="gf-question-title" for="stok_tangki_2_l">
            Stok Tangki 2 (L)
        </label>
        <div class="gf-question-desc">Sisa stok aktual Tangki 2 dalam Liter (L).</div>
        <input type="number" step="any" name="stok_tangki_2_l" id="stok_tangki_2_l" class="gf-input-text" placeholder="Jawaban Anda" value="{{ old('stok_tangki_2_l') }}">
        @error('stok_tangki_2_l')
            <div class="gf-alert-error">{{ $message }}</div>
        @enderror
    </div>

    <!-- Submit Action Bar -->
    <div class="gf-action-bar">
        <button type="submit" class="btn-gf-submit">
            <i class="fa-solid fa-paper-plane"></i> Kirim
        </button>
        <button type="reset" class="btn-gf-clear" onclick="return confirm('Apakah Anda yakin ingin mengosongkan isi formulir?');">
            Kosongkan formulir
        </button>
    </div>
</form>
@endsection
