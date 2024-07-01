<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\JadwalDokter;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $data = Dokter::with('jadwalDokter');
        if ($search) {
            $data = $data->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('spesialis', 'like', '%' . $search . '%')
                    ->orWhere('gender', 'like', '%' . $search . '%')
                    ->orWhere('age', 'like', '%' . $search . '%');
            });
        }

        $data = $data->get();

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
