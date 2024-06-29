<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\JadwalDokter;
use App\Models\JanjiTemu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class JanjiTemuController extends Controller
{

    public function store(Request $request, string $dokter_id)
    {

        $user = auth()->user();

        // Cek kelengkapan profil
        if (
            !$user->pasien ||
            !$user->pasien->name ||
            !$user->pasien->birth_date ||
            !$user->pasien->age ||
            !$user->pasien->gender ||
            !$user->address ||
            !$user->phone_number
        ) {
            return redirect('/pasien/dokter')
                ->withErrors('Tolong lengkapi profil Anda terlebih dahulu sebelum membuat janji temu.');
        }

        // Verify password
        if (!Hash::check($request->password, auth()->user()->password)) {
            return redirect('/pasien/dokter')->withErrors('Password yang dimasukkan tidak sesuai.');
        }

        $pasien_id = $user->pasien->id;

        $slot = $request->input('slot');
        [$startTime, $endTime] = explode('-', $slot);

        JanjiTemu::create([
            'pasien_id' => $pasien_id,
            'dokter_id' => $dokter_id,
            'date' => $request->date,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'note' => $request->note,
            'status' => 'Scheduled',
        ]);

        JadwalDokter::where('dokter_id', $dokter_id)
            ->where('date', $request->date)
            ->where('start_time', $request->start_time)
            ->where('end_time', $request->end_time)
            ->update(['status' => 'Unavailable']);

        return redirect('/pasien/janjitemu')->with('success', 'Appointment scheduled successfully!');
    }

    public function show()
    {
        if (!auth()->user()->pasien) {
            return redirect('/pasien/dokter')->withErrors('Tolong lengkapi profil Anda terlebih dahulu sebelum mengakses janji temu.');
        }

        $data = JanjiTemu::where('pasien_id', auth()->user()->pasien->id)->get();
        return view('pasien.janjitemu', compact('data'));
    }


    public function update(Request $request, string $id)
    {
    }


    public function destroy(string $id)
    {
        //
    }
}
