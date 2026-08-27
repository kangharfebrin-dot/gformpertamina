@extends('layouts.app')

@section('title', 'Data Rekap Monitoring (Google Sheets View) - Pertamina Patra Niaga FT Maos')

@section('styles')
<style>
    .sheets-wrapper {
        max-width: 1200px;
        margin: 0 auto;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 16px;
        margin-bottom: 24px;
    }

    .stat-card {
        background: #ffffff;
        border-radius: 10px;
        padding: 18px 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        border: 1px solid #e0e0e0;
        border-top: 4px solid var(--pertamina-blue);
    }

    .stat-title {
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #5f6368;
        font-weight: 600;
        margin-bottom: 6px;
    }

    .stat-value {
        font-size: 24px;
        font-weight: 700;
        color: var(--pertamina-dark);
    }

    .stat-desc {
        font-size: 12px;
        color: #70757a;
        margin-top: 4px;
    }

    /* Google Sheets Toolbar Container */
    .sheets-container {
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        border: 1px solid #dadce0;
        overflow: hidden;
    }

    .sheets-toolbar {
        background-color: #f8f9fa;
        padding: 12px 20px;
        border-bottom: 1px solid #e0e0e0;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }

    .sheets-title-group {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .sheets-title-group img {
        width: 24px;
        height: 24px;
    }

    .sheets-title {
        font-size: 18px;
        font-weight: 600;
        color: #202124;
    }

    .sheets-tab-badge {
        background-color: #4C3281;
        color: #ffffff;
        padding: 4px 10px;
        border-radius: 4px 4px 0 0;
        font-size: 12px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .sheets-actions {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .btn-sheets-csv {
        background-color: #107c41;
        color: #ffffff;
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: background-color 0.2s;
    }

    .btn-sheets-csv:hover {
        background-color: #0b5c30;
        color: #ffffff;
    }

    /* Filter Bar */
    .filter-bar {
        padding: 12px 20px;
        background-color: #ffffff;
        border-bottom: 1px solid #f1f3f4;
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .filter-input {
        padding: 6px 12px;
        border: 1px solid #dadce0;
        border-radius: 4px;
        font-size: 13px;
        outline: none;
    }

    .filter-input:focus {
        border-color: var(--pertamina-blue);
    }

    /* Table Container */
    .table-responsive {
        width: 100%;
        overflow-x: auto;
    }

    .sheets-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
        white-space: nowrap;
    }

    .sheets-table th {
        background-color: #4C3281; /* Matches the purple header in the photo! */
        color: #ffffff;
        font-weight: 600;
        text-align: left;
        padding: 10px 14px;
        border: 1px solid #6343a0;
    }

    .sheets-table td {
        padding: 9px 14px;
        border: 1px solid #e0e0e0;
        color: #3c4043;
    }

    .sheets-table tbody tr:nth-child(even) {
        background-color: #f9fbfd;
    }

    .sheets-table tbody tr:hover {
        background-color: #e8f0fe;
    }

    .empty-state {
        padding: 48px;
        text-align: center;
        color: #70757a;
    }
</style>
@endsection

@section('content')
<div class="sheets-wrapper">

    <!-- KPI Summary Cards -->
    <div class="stats-grid">
        <div class="stat-card" style="border-top-color: var(--pertamina-blue);">
            <div class="stat-title">Total Tanggapan</div>
            <div class="stat-value">{{ number_format($totalCount) }}</div>
            <div class="stat-desc">Entri data tersimpan</div>
        </div>

        <div class="stat-card" style="border-top-color: var(--pertamina-green);">
            <div class="stat-title">Avg. Density Awal</div>
            <div class="stat-value">{{ number_format($avgDensityAwal ?? 0, 3) }}</div>
            <div class="stat-desc">Rata-rata massa jenis awal</div>
        </div>

        <div class="stat-card" style="border-top-color: var(--pertamina-red);">
            <div class="stat-title">Avg. Density Akhir</div>
            <div class="stat-value">{{ number_format($avgDensityAkhir ?? 0, 3) }}</div>
            <div class="stat-desc">Rata-rata massa jenis akhir</div>
        </div>

        <div class="stat-card" style="border-top-color: #f59e0b;">
            <div class="stat-title">Total Volume Penyaluran</div>
            <div class="stat-value">{{ number_format($totalVolumePenyaluran ?? 0, 0, ',', '.') }} L</div>
            <div class="stat-desc">Akumulasi penyaluran BBM</div>
        </div>
    </div>

    <!-- Google Sheets Replica Table Container -->
    <div class="sheets-container">
        <div class="sheets-toolbar">
            <div class="sheets-title-group">
                <i class="fa-solid fa-file-excel" style="color: #107c41; font-size: 22px;"></i>
                <div>
                    <div class="sheets-title">Monitoring (Responses)</div>
                    <div class="sheets-tab-badge">
                        <i class="fa-solid fa-table"></i> Form Responses 1
                    </div>
                </div>
            </div>

            <div class="sheets-actions">
                <a href="{{ route('monitoring.form') }}" class="nav-link" style="border: 1px solid #dadce0;">
                    <i class="fa-solid fa-plus"></i> Tambah Entry
                </a>
                <a href="{{ route('monitoring.export') }}" class="btn-sheets-csv">
                    <i class="fa-solid fa-file-csv"></i> Download CSV
                </a>
            </div>
        </div>

        <!-- Filter Search Bar -->
        <form action="{{ route('monitoring.responses') }}" method="GET" class="filter-bar">
            <input type="text" name="search" class="filter-input" placeholder="Cari email / lokasi..." value="{{ request('search') }}" style="width: 220px;">
            <select name="lokasi" class="filter-input" onchange="this.form.submit()">
                <option value="">Semua Lokasi</option>
                @foreach($lokasiList as $lok)
                    <option value="{{ $lok }}" {{ request('lokasi') == $lok ? 'selected' : '' }}>{{ $lok }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn-gf-submit" style="padding: 6px 16px; font-size: 13px;">
                <i class="fa-solid fa-magnifying-glass"></i> Filter
            </button>
            @if(request('search') || request('lokasi'))
                <a href="{{ route('monitoring.responses') }}" class="btn-gf-clear" style="font-size: 13px;">Reset</a>
            @endif
        </form>

        <!-- Table matching screenshot columns -->
        <div class="table-responsive">
            <table class="sheets-table">
                <thead>
                    <tr>
                        <th>Timestamp</th>
                        <th>Email Address</th>
                        <th>Tanggal</th>
                        <th>Lokasi</th>
                        <th>Stok Awal (MM)</th>
                        <th>Volume Stok Awal (L)</th>
                        <th>Density Awal Penyaluran</th>
                        <th>Temperature (°C)</th>
                        <th>Jam Antar Penyaluran (Jam)</th>
                        <th>Stok Akhir (MM)</th>
                        <th>Volume Akhir (L)</th>
                        <th>Density Akhir</th>
                        <th>Volume Akhir Penyaluran (L)</th>
                        <th>Stok Tangki 1 (L)</th>
                        <th>Stok Tangki 2 (L)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($responses as $res)
                        <tr>
                            <td>{{ $res->created_at->format('Y-m-d H:i:s') }}</td>
                            <td><strong>{{ $res->email_address }}</strong></td>
                            <td>{{ $res->tanggal }}</td>
                            <td><span style="background: #e8f0fe; color: #1a73e8; padding: 2px 8px; border-radius: 4px; font-size: 12px; font-weight: 500;">{{ $res->lokasi }}</span></td>
                            <td>{{ $res->stok_awal_mm ?? '-' }}</td>
                            <td>{{ $res->volume_stok_awal_l ? number_format($res->volume_stok_awal_l, 0, ',', '.') : '-' }}</td>
                            <td>{{ $res->density_awal_penyaluran ?? '-' }}</td>
                            <td>{{ $res->temperature_c ?? '-' }}</td>
                            <td>{{ $res->jam_antar_penyaluran ?? '-' }}</td>
                            <td>{{ $res->stok_akhir_mm ?? '-' }}</td>
                            <td>{{ $res->volume_akhir_l ? number_format($res->volume_akhir_l, 0, ',', '.') : '-' }}</td>
                            <td>{{ $res->density_akhir ?? '-' }}</td>
                            <td>{{ $res->volume_akhir_penyaluran_l ? number_format($res->volume_akhir_penyaluran_l, 0, ',', '.') : '-' }}</td>
                            <td>{{ $res->stok_tangki_1_l ? number_format($res->stok_tangki_1_l, 0, ',', '.') : '-' }}</td>
                            <td>{{ $res->stok_tangki_2_l ? number_format($res->stok_tangki_2_l, 0, ',', '.') : '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="15" class="empty-state">
                                <i class="fa-solid fa-inbox" style="font-size: 32px; color: #dadce0; margin-bottom: 8px;"></i>
                                <p>Belum ada data monitoring yang dimasukkan.</p>
                                <a href="{{ route('monitoring.form') }}" style="color: var(--pertamina-blue); margin-top: 8px; display: inline-block;">Klik untuk mengisi Formulir Monitoring</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($responses->hasPages())
            <div style="padding: 16px 20px; background: #fafafa; border-top: 1px solid #e0e0e0;">
                {{ $responses->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
