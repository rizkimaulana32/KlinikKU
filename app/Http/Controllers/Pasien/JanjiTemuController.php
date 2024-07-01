<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\JadwalDokter;
use App\Models\JanjiTemu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class JanjiTemuController extends Controller
{

    public function index()
    {

        if (!auth()->user()->pasien) {
            return redirect('/pasien/profile')->with('error', 'Tolong lengkapi profil Anda terlebih dahulu sebelum mengakses janji temu.');
        }

        $pasien_id = auth()->user()->pasien->id;
        $data = JanjiTemu::where('pasien_id', $pasien_id)->orderBy('id', 'desc')->get();

        return view('pasien.janjitemu', compact('data'));
    }

    public function store(Request $request, string $dokter_id)
    {

        $user = auth()->user();

        // Validasi input dari form
        $request->validate([
            'date' => 'required|date',
            'slot' => 'required',
            'note' => 'required',
            'password' => 'required|min:8',
        ]);

        // Verify password
        if (!Hash::check($request->password, auth()->user()->password)) {
            return redirect('/pasien/dokter')->with('error', 'Password yang dimasukkan tidak sesuai.');
        }

        // Cek kelengkapan profil
        if (
            !$user->pasien ||
            !$user->pasien->name ||
            !$user->pasien->birth_date ||
            !$user->pasien->age ||
            !$user->pasien->gender ||
            !$user->pasien->address ||
            !$user->pasien->phone
        ) {
            return redirect('/pasien/profile')
                ->with('error', 'Tolong lengkapi profil Anda terlebih dahulu sebelum membuat janji temu.');
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
            ->where('start_time', $startTime)
            ->where('end_time', $endTime)
            ->update(['status' => 'Unavailable']);

        return redirect('/pasien/janjitemu')->with('success', 'Janji temu berhasil dibuat!');
    }

    public function update(Request $request, string $id)
    {
        // Validasi input dari form
        $request->validate([
            'date' => 'required|date',
            'slot' => 'required',
            'note' => 'required',
        ]);

        // Verify password
        if (!Hash::check(
            $request->password,
            auth()->user()->password
        )) {
            return redirect('/pasien/janjitemu')->with('error', 'Password yang dimasukkan tidak sesuai.');
        }


        // Cari janji temu berdasarkan ID
        $janjiTemu = JanjiTemu::findOrFail($id);

        // Jika status janji temu sebelumnya adalah 'Scheduled', ubah status jadwal dokter menjadi 'Available'
        if ($janjiTemu->status === 'Scheduled') {
            JadwalDokter::where('dokter_id', $janjiTemu->dokter_id)
                ->where('date', $janjiTemu->date)
                ->where('start_time', $janjiTemu->start_time)
                ->where('end_time', $janjiTemu->end_time)
                ->update(['status' => 'Available']);
        }

        // Pisahkan waktu slot menjadi start_time dan end_time
        [$startTime, $endTime] = explode('-', $request->input('slot'));

        // Ubah status jadwal dokter menjadi 'Unavailable' untuk slot yang diupdate
        JadwalDokter::where('dokter_id', $janjiTemu->dokter_id)
            ->where('date', $request->date)
            ->where('start_time', $startTime)
            ->where('end_time', $endTime)
            ->update(['status' => 'Unavailable']);

        // Update janji temu dengan data baru
        $janjiTemu->update([
            'date' => $request->date,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'note' => $request->note,
            'status' => 'Scheduled', // Ubah status menjadi 'Scheduled' untuk janji temu baru
        ]);

        // Redirect kembali ke halaman daftar janji temu dengan pesan sukses
        return redirect('/pasien/janjitemu')->with('success', 'Janji temu berhasil diupdate!');
    }



    public function destroy(Request $request, string $id)
    {
        $request->validate([
            'password' => 'required|min:8',
        ]);

        // Verify password
        if (!Hash::check($request->password, auth()->user()->password)) {
            return redirect('/pasien/janjitemu')->with('error', 'Password yang dimasukkan tidak sesuai.');
        }

        // Ambil informasi janji temu yang akan dihapus
        $janjiTemu = JanjiTemu::findOrFail($id);

        // Hapus janji temu
        $janjiTemu->delete();

        // Perbarui status jadwal dokter menjadi Available jika sudah Scheduled
        if ($janjiTemu->status === 'Scheduled') {
            JadwalDokter::where('dokter_id', $janjiTemu->dokter_id)
                ->where('date', $janjiTemu->date)
                ->where('start_time', $janjiTemu->start_time)
                ->where('end_time', $janjiTemu->end_time)
                ->update(['status' => 'Available']);
        }

        return redirect('/pasien/janjitemu')->with('success', 'Janji temu berhasil dibatalkan!');
    }
}
