<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\JadwalDokter;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = Dokter::with('jadwalDokter')->get();
        return view('dashboard', compact('data'));
    }

    public function fetchAvailableSchedules($doctorId, $date)
    {
        $schedules = Dokter::findOrFail($doctorId)
            ->jadwalDokter()
            ->where('date', $date)
            ->where('status', 'Available')
            ->get();

        return response()->json($schedules);
    }
}
