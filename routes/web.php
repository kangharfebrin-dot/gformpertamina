<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MonitoringController;

Route::get('/', [MonitoringController::class, 'index'])->name('monitoring.form');
Route::post('/submit', [MonitoringController::class, 'store'])->name('monitoring.store');
Route::get('/success', [MonitoringController::class, 'success'])->name('monitoring.success');
Route::get('/responses', [MonitoringController::class, 'responses'])->name('monitoring.responses');
Route::get('/export-csv', [MonitoringController::class, 'exportCsv'])->name('monitoring.export');
