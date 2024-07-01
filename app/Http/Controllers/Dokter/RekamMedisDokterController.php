<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\JanjiTemu;
use App\Models\RekamMedis;
use Illuminate\Http\Request;

class RekamMedisDokterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $janji_temu_id)
    {
        // Ambil rekam medis berdasarkan janji_temu_id
        $rekammedis = RekamMedis::where('janji_temu_id', $janji_temu_id)->first();

        // Kembalikan tampilan dengan data rekam medis dan janji_temu_id
        return view('dokter.janjitemu.rekammedis.index', compact('rekammedis', 'janji_temu_id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $janji_temu_id)
    {
        $status = JanjiTemu::where('id', $janji_temu_id)->first()->status;
        if ($status === 'Scheduled') {
            return redirect('/dokter/janjitemu/' . $janji_temu_id . '/rekammedis')->with('error', 'Unable to add Rekam Medis. Status appointment is not yet completed.');
        }
        return view('dokter.janjiTemu.rekammedis.create', compact('janji_temu_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $janji_temu_id)
    {
        $rekamMedisExists = RekamMedis::where('janji_temu_id', $janji_temu_id)->exists();
        $janjiTemu = JanjiTemu::findOrFail($janji_temu_id);
        $pasienId = $janjiTemu->pasien_id;

        if ($rekamMedisExists) {
            return redirect()->back()->with('error', 'Rekam Medis for this appointment already exists.');
        }

        $request->validate([
            'diagnosis' => 'required',
            'obat' => 'required',
            'tindakan' => 'required',
        ]);

        RekamMedis::create([
            'janji_temu_id' => $janji_temu_id,
            'pasien_id' => $pasienId,
            'diagnosis' => $request->diagnosis,
            'obat' => $request->obat,
            'tindakan' => $request->tindakan,
        ]);

        return redirect('dokter/janjitemu/' . $janji_temu_id . '/rekammedis')->with('success', 'Rekam Medis created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $janji_temu_id, string $rekam_medis_id)
    {
        $rekammedis = RekamMedis::where('id', $rekam_medis_id)->firstOrFail();
        return view('dokter.janjiTemu.rekammedis.edit', compact('rekammedis', 'janji_temu_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $janji_temu_id, string $rekam_medis_id)
    {
        $request->validate([
            'diagnosis' => 'required',
            'obat' => 'required',
            'tindakan' => 'required',
        ]);

        RekamMedis::where('id', $rekam_medis_id)->update([
            'diagnosis' => $request->diagnosis,
            'obat' => $request->obat,
            'tindakan' => $request->tindakan,
        ]);

        return redirect('dokter/janjitemu/' . $janji_temu_id . '/rekammedis')->with('success', 'Rekam medis updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $janji_temu_id, string $rekam_medis_id)
    {
        $data = RekamMedis::find($rekam_medis_id);
        $data->delete();
        return redirect('dokter/janjitemu/' . $janji_temu_id . '/rekammedis')->with('success', 'Rekam Medis deleted successfully.');
    }
}
