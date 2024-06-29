<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\JanjiTemu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class JanjiTemuController extends Controller
{

    public function store(Request $request, string $dokter_id)
    {

        $user = auth()->user();

        // Cek kelengkapan profil
        if (!$user->pasien->name || !$user->pasien->birth_date || !$user->pasien->age || !$user->pasien->gender || !$user->address || !$user->phone_number || !$user->pasien) {
            return redirect('/profile/edit')->with('error', 'Please complete your profile before making an appointment.');
        }

        // Verify password
        if (!Hash::check($request->password, auth()->user()->password)) {
            return redirect('/pasien/dokter')->withErrors('Password yang dimasukkan tidak sesuai.');
        }

        $pasien_id = $user->pasien->id;

        $slot = $request->input('slot');
        [$startTime, $endTime] = explode('-', $slot);
        dd($startTime, $endTime);

        JanjiTemu::create([
            'pasien_id' => $pasien_id,
            'dokter_id' => $dokter_id,
            'date' => $request->date,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'note' => $request->note,
            'status' => 'Scheduled',
        ]);

        return redirect('/pasien/janjitemu')->with('success', 'Appointment scheduled successfully!');
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}
