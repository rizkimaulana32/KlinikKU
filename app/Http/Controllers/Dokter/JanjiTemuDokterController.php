<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\JadwalDokter;
use App\Models\JanjiTemu;
use Illuminate\Http\Request;

class JanjiTemuDokterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $dokter_id = auth()->user()->dokter->id;
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

        return view('dokter.janjiTemu.index', compact('data'));
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

    public function getAvailableSlots(Request $request)
    {
        $date = $request->query('date');

        $dokter_id = auth()->user()->dokter->id;
        $available_slots = JadwalDokter::where('dokter_id', $dokter_id)
            ->where('date', $date)
            ->where('status', 'Available')
            ->get(['start_time', 'end_time']);

        return response()->json($available_slots);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dokter_id = auth()->user()->dokter->id;
        $data = JanjiTemu::where('id', $id)->firstOrFail();
        $available_slots = JadwalDokter::where('dokter_id', $dokter_id)
            ->where('date', $data->date) // Use the existing date of the appointment
            ->where('status', 'Available')
            ->get(['start_time', 'end_time']);

        // Add previously selected slot if it is not available anymore
        $selected_slot = JadwalDokter::where('dokter_id', $dokter_id)
            ->where('date', $data->date)
            ->where('start_time', $data->start_time)
            ->where('end_time', $data->end_time)
            ->first();

        if ($selected_slot && !$available_slots->contains('start_time', $selected_slot->start_time)) {
            $available_slots->push($selected_slot);
        }

        return view('dokter.janjiTemu.edit', compact('data', 'available_slots'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'status' => 'required',
            'note' => 'required',
        ]);

        // Dapatkan janji temu yang akan diperbarui
        $appointment = JanjiTemu::findOrFail($id);
        $dokter_id = auth()->user()->dokter->id;

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

        return redirect('/dokter/janjitemu')->with('success', 'Appointment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = JanjiTemu::where('id', $id)->firstOrFail();
        $data->delete();
        return redirect('/dokter/janjitemu')->with('success', 'Appointment deleted successfully');
    }
}
