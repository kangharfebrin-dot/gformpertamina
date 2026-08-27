<?php

namespace App\Http\Controllers;

use App\Models\MonitoringResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class MonitoringController extends Controller
{
    /**
     * Display the Google Form replica view.
     */
    public function index()
    {
        return view('monitoring.form');
    }

    /**
     * Store a newly created response in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email_address'             => 'required|email|max:255',
            'tanggal'                   => 'required|date',
            'lokasi'                    => 'required|string|max:255',
            'stok_awal_mm'              => 'nullable|numeric',
            'volume_stok_awal_l'        => 'nullable|numeric',
            'density_awal_penyaluran'   => 'nullable|numeric',
            'temperature_c'             => 'nullable|numeric',
            'jam_antar_penyaluran'      => 'nullable|string|max:100',
            'stok_akhir_mm'             => 'nullable|numeric',
            'volume_akhir_l'            => 'nullable|numeric',
            'density_akhir'             => 'nullable|numeric',
            'volume_akhir_penyaluran_l' => 'nullable|numeric',
            'stok_tangki_1_l'           => 'nullable|numeric',
            'stok_tangki_2_l'           => 'nullable|numeric',
        ]);

        MonitoringResponse::create($validated);

        return redirect()->route('monitoring.success')
            ->with('status', 'Tanggapan Anda telah direkam.');
    }

    /**
     * Display response success confirmation card.
     */
    public function success()
    {
        return view('monitoring.success');
    }

    /**
     * Display responses in Google Sheets / Table format.
     */
    public function responses(Request $request)
    {
        $query = MonitoringResponse::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('email_address', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%")
                  ->orWhere('tanggal', 'like', "%{$search}%");
            });
        }

        if ($request->filled('lokasi')) {
            $query->where('lokasi', $request->lokasi);
        }

        $responses = $query->orderBy('created_at', 'desc')->paginate(15);
        $totalCount = MonitoringResponse::count();
        $avgDensityAwal = MonitoringResponse::avg('density_awal_penyaluran');
        $avgDensityAkhir = MonitoringResponse::avg('density_akhir');
        $totalVolumePenyaluran = MonitoringResponse::sum('volume_akhir_penyaluran_l');

        $lokasiList = MonitoringResponse::select('lokasi')->distinct()->pluck('lokasi');

        return view('monitoring.responses', compact(
            'responses',
            'totalCount',
            'avgDensityAwal',
            'avgDensityAkhir',
            'totalVolumePenyaluran',
            'lokasiList'
        ));
    }

    /**
     * Export all monitoring responses as a CSV file.
     */
    public function exportCsv()
    {
        $headers = [
            "Content-type"        => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=Monitoring_Form_Responses_" . date('Y-m-d_H-i-s') . ".csv",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = [
            'Timestamp',
            'Email Address',
            'Tanggal',
            'Lokasi',
            'Stok Awal (MM)',
            'Volume Stok Awal (L)',
            'Density Awal Penyaluran',
            'Temperature (°C)',
            'Jam Antar Penyaluran (Jam)',
            'Stok Akhir (MM)',
            'Volume Akhir (L)',
            'Density Akhir',
            'Volume Akhir Penyaluran (L)',
            'Stok Tangki 1 (L)',
            'Stok Tangki 2 (L)'
        ];

        $callback = function () use ($columns) {
            $file = fopen('php://output', 'w');
            // Write BOM for UTF-8 compatibility in Excel
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            fputcsv($file, $columns);

            MonitoringResponse::chunk(200, function ($data) use ($file) {
                foreach ($data as $row) {
                    fputcsv($file, [
                        $row->created_at ? $row->created_at->format('Y-m-d H:i:s') : '',
                        $row->email_address,
                        $row->tanggal,
                        $row->lokasi,
                        $row->stok_awal_mm,
                        $row->volume_stok_awal_l,
                        $row->density_awal_penyaluran,
                        $row->temperature_c,
                        $row->jam_antar_penyaluran,
                        $row->stok_akhir_mm,
                        $row->volume_akhir_l,
                        $row->density_akhir,
                        $row->volume_akhir_penyaluran_l,
                        $row->stok_tangki_1_l,
                        $row->stok_tangki_2_l,
                    ]);
                }
            });

            fclose($file);
        };

        return new StreamedResponse($callback, 200, $headers);
    }
}
