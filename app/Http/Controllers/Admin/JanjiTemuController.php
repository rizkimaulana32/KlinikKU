<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalDokter;
use App\Models\JanjiTemu;
use Illuminate\Http\Request;

class JanjiTemuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, string $dokter_id)
    {
        $query = JanjiTemu::where('dokter_id', $dokter_id)->with('pasien');

        $search = $request->search;
        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('date', 'like', '%' . $search . '%')
                    ->orWhere('start_time', 'like', '%' . $search . '%')
                    ->orWhere('end_time', 'like', '%' . $search . '%')
                    ->orWhere('status', 'like', '%' . $search . '%')
                    ->orWhere('note', 'like', '%' . $search . '%')
                    ->orWhereHas('pasien', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    });
            });
        }

        $data = $query->orderBy('date', 'asc')->paginate(10);

        return view('admin.list.janjiTemu.index', compact('data', 'dokter_id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    // public function edit(string $dokter_id, string $jadwal_id)
    // {
    //     $data = JadwalDokter::where('id', $jadwal_id)->firstOrFail();
    //     $available_slots = JadwalDokter::where('dokter_id', $dokter_id)
    //         ->where('status', 'Available')
    //         ->get(['start_time', 'end_time']);

    //     return view('admin.dokter.jadwal.edit', compact('data', 'dokter_id', 'available_slots'));
    // }

    public function getAvailableSlots(Request $request, string $dokter_id)
    {
        $date = $request->query('date');

        $available_slots = JadwalDokter::where('dokter_id', $dokter_id)
            ->where('date', $date)
            ->where('status', 'Available')
            ->get(['start_time', 'end_time']);

        return response()->json($available_slots);
    }


    public function edit(string $dokter_id, string $janjitemu_id)
    {
        $data = JanjiTemu::where('id', $janjitemu_id)->firstOrFail();
        $available_slots = JadwalDokter::where('dokter_id', $dokter_id)
            ->where('date', $data->date) // Use the existing date of the appointment
            ->where('status', 'Available')
            ->get(['start_time', 'end_time']);

        return view('admin.list.janjitemu.edit', compact('data', 'dokter_id', 'available_slots'));
    }

    public function update(Request $request, string $dokter_id, string $janjitemu_id)
    {
        $request->validate([
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'status' => 'required',
            'note' => 'required',
        ]);

        // Dapatkan janji temu yang akan diperbarui
        $appointment = JanjiTemu::findOrFail($janjitemu_id);

        // Simpan slot waktu lama sebelum diperbarui
        $oldStartTime = $appointment->start_time;
        $oldEndTime = $appointment->end_time;
        $oldDate = $appointment->date;

        // Perbarui janji temu
        $appointment->update([
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status' => $request->status,
            'note' => $request->note,
        ]);

        // Setel ulang status jadwal dokter yang lama menjadi "available" jika tidak lagi digunakan oleh janji temu lainnya
        $oldSlotInUse = JanjiTemu::where('date', $oldDate)
            ->where('start_time', $oldStartTime)
            ->where('end_time', $oldEndTime)
            ->exists();

        if (!$oldSlotInUse) {
            JadwalDokter::where('dokter_id', $dokter_id)
                ->where('date', $oldDate)
                ->where('start_time', $oldStartTime)
                ->where('end_time', $oldEndTime)
                ->update(['status' => 'available']);
        }

        // Perbarui status jadwal dokter yang baru menjadi "unavailable"
        JadwalDokter::where('dokter_id', $dokter_id)
            ->where('date', $request->date)
            ->where('start_time', $request->start_time)
            ->where('end_time', $request->end_time)
            ->update(['status' => 'unavailable']);

        return redirect('/admin/list/' . $dokter_id . '/janjitemu')->with('success', 'Appointment updated successfully');
    }


    // public function update(Request $request, string $dokter_id, string $janjitemu_id)
    // {
    //     $request->validate([
    //         'date' => 'required|date',
    //         'start_time' => 'required',
    //         'end_time' => 'required',
    //         'status' => 'required',
    //         'note' => 'required',
    //     ]);

    //     JanjiTemu::where('id', $janjitemu_id)->update([
    //         'date' => $request->date,
    //         'start_time' => $request->start_time,
    //         'end_time' => $request->end_time,
    //         'status' => $request->status,
    //         'note' => $request->note,
    //     ]);

    //     JadwalDokter::where('id', $jadwal_id)->update([
    //         'start_time' => $request->start_time,
    //         'end_time' => $request->end_time,
    //         'status' => 'Unavailable',
    //     ]);

    //     return redirect('/admin/list/' . $dokter_id . '/janjitemu')->with('success', 'Appointment updated successfully');
    // }


    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, string $dokter_id, string $janjitemu_id)
    // {
    //     $request->validate([
    //         'date' => 'required',
    //         'start_time' => 'required',
    //         'end_time' => 'required',
    //         'status' => 'required',
    //         'note' => 'required',
    //     ]);;

    //     JanjiTemu::where('id', $janjitemu_id)->update([
    //         'date' => $request->date,
    //         'start_time' => $request->start_time,
    //         'end_time' => $request->end_time,
    //         'status' => $request->status,
    //         'note' => $request->note,
    //     ]);

    //     return redirect('/admin/list/' . $dokter_id . '/janjitemu');
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $dokter_id, string $janjitemu_id)
    {
        JanjiTemu::where('id', $janjitemu_id)->delete();
        return redirect('/admin/list/' . $dokter_id . '/janjitemu');
    }
}
