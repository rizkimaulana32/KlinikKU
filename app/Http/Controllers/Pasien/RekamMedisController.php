<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use Illuminate\Http\Request;

class RekamMedisController extends Controller
{
    public function index()
    {
        if (!auth()->user()->pasien) {
            return redirect('/pasien/profile')->with('error', 'Tolong lengkapi profil Anda terlebih dahulu sebelum mengakses Rekam Medis.');
        }

        $data = RekamMedis::where('pasien_id', auth()->user()->pasien->id)->get();

        return view('pasien.rekam', compact('data'));
    }
}
