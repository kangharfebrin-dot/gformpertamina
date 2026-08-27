@extends('layouts.app')

@section('title', 'Tanggapan Terekam - Pertamina Patra Niaga FT Maos')

@section('content')
<div class="gf-card gf-header-card" style="border-top: 10px solid var(--pertamina-red);">
    <div class="gf-header-content" style="border-top: none; padding-top: 32px; padding-bottom: 32px;">
        <div class="gf-form-badge" style="background-color: #e6f4ea; color: #137333;">
            <i class="fa-solid fa-circle-check" style="color: #137333;"></i> Sukses
        </div>
        <h1 class="gf-form-title" style="font-size: 26px;">Monitoring Penyaluran & Stok</h1>
        <p style="font-size: 15px; color: #202124; margin-top: 12px; margin-bottom: 24px;">
            Tanggapan Anda telah direkam ke dalam sistem monitoring Pertamina Patra Niaga FT Maos.
        </p>

        <div style="display: flex; flex-direction: column; gap: 12px;">
            <a href="{{ route('monitoring.form') }}" style="color: var(--pertamina-blue); text-decoration: underline; font-size: 14px; font-weight: 500;">
                <i class="fa-solid fa-rotate-left"></i> Kirim tanggapan lain
            </a>
            <a href="{{ route('monitoring.responses') }}" style="color: var(--pertamina-blue); text-decoration: underline; font-size: 14px; font-weight: 500;">
                <i class="fa-solid fa-table-cells"></i> Lihat Rekap Data Monitoring (Spreadsheet View)
            </a>
        </div>
    </div>
</div>
@endsection
