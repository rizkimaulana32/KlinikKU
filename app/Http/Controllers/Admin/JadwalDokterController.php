<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\JadwalDokter;
use Illuminate\Http\Request;

class JadwalDokterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $dokter_id, Request $request)
    {
        $query = JadwalDokter::where('dokter_id', $dokter_id);

        $search = $request->search;
        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('date', 'like', '%' . $search . '%')
                    ->orWhere('start_time', 'like', '%' . $search . '%')
                    ->orWhere('end_time', 'like', '%' . $search . '%')
                    ->orWhere('status', 'like', '%' . $search . '%');
            });
        }

        $data = $query->orderBy('date', 'asc')->paginate(10);

        return view('admin.list.jadwal.index', compact('data', 'dokter_id'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(string $dokter_id)
    {

        return view('admin.list.jadwal.create', ['dokter_id' => $dokter_id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $dokter_id)
    {
        if (JadwalDokter::where('dokter_id', $dokter_id)
            ->where('date', $request->date)
            ->where(function ($query) use ($request) {
                $query->where('start_time', $request->start_time)
                    ->orWhere('end_time', $request->end_time);
            })
            ->exists()
        ) {
            return redirect('/admin/list/' . $dokter_id . '/jadwal')->with('error', 'Failed to create. Doctor\'s schedule already exists');
        }

        $request->validate([
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'status' => 'required',
        ]);;

        JadwalDokter::create([
            'dokter_id' => $dokter_id,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status' => $request->status,
        ]);

        return redirect('/admin/list/' . $dokter_id . '/jadwal')->with('success', 'Doctor\'s schedule created successfully');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $dokter_id, string $jadwal_id)
    {
        $data = JadwalDokter::where('id', $jadwal_id)->firstOrFail();
        return view('admin.list.jadwal.edit', compact('data', 'dokter_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $dokter_id, string $jadwal_id)
    {
        if (JadwalDokter::where('dokter_id', $dokter_id)
            ->where('date', $request->date)
            ->where(function ($query) use ($request) {
                $query->where('start_time', $request->start_time)
                    ->orWhere('end_time', $request->end_time);
            })
            ->exists()
        ) {
            return redirect('/admin/list/' . $dokter_id . '/jadwal')->with('error', 'Failed to update. Doctor\'s schedule already exists');
        }

        $request->validate([
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'status' => 'required',
        ]);;

        JadwalDokter::where('id', $jadwal_id)->update([
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status' => $request->status,
        ]);

        return redirect('/admin/list/' . $dokter_id . '/jadwal')->with('success', 'Doctor\'s schedule updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $dokter_id, string $jadwal_id)
    {
        $data = JadwalDokter::where('id', $jadwal_id)->firstOrFail();
        $data->delete();
        return redirect('/admin/list/' . $dokter_id . '/jadwal')->with('success', 'Doctor\'s schedule deleted successfully');
    }
}
