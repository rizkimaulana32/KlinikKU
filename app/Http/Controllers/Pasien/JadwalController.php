<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\JadwalDokter;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $data = Dokter::with('jadwalDokter')->get();
        return view('pasien.dokter', compact('data'));
    }

    public function getAvailableSlots(Request $request, string $dokter_id)
    {
        $date = $request->query('date');

        $available_slots = JadwalDokter::where('dokter_id', $dokter_id)
            ->where('date', $date)
            ->where('status', 'Available')
            ->get(['start_time', 'end_time']);

        return response()->json($available_slots);
    }
}
