<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\JadwalDokter;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $dokter_id = auth()->user()->dokter->id;
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

        return view('dokter.jadwal.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dokter.jadwal.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dokter_id = auth()->user()->dokter->id;

        if (JadwalDokter::where('dokter_id', $dokter_id)
            ->where('date', $request->date)
            ->where(function ($query) use ($request) {
                $query->where('start_time', $request->start_time)
                    ->orWhere('end_time', $request->end_time);
            })
            ->exists()
        ) {
            return redirect('/dokter/jadwal')->with('error', 'Failed to create. Doctor\'s schedule already exists');
        }

        $request->validate([
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'status' => 'required',
        ]);

        JadwalDokter::create([
            'dokter_id' => $dokter_id,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status' => $request->status,
        ]);

        return redirect('/dokter/jadwal')->with('success', 'Schedule created successfully');
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
    public function edit(string $id)
    {
        $data = JadwalDokter::where('id', $id)->firstOrFail();
        return view('dokter.jadwal.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dokter_id = auth()->user()->dokter->id;
        if (JadwalDokter::where('dokter_id', $dokter_id)
            ->where('date', $request->date)
            ->where(function ($query) use ($request) {
                $query->where('start_time', $request->start_time)
                    ->orWhere('end_time', $request->end_time);
            })
            ->exists()
        ) {
            return redirect('/dokter/jadwal')->with('error', 'Failed to update. Doctor\'s schedule already exists');
        }

        $data = JadwalDokter::where('id', $id)->firstOrFail();
        $request->validate([
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'status' => 'required',
        ]);
        $data->update($request->all());
        return redirect('/dokter/jadwal')->with('success', 'Schedule updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = JadwalDokter::where('id', $id)->firstOrFail();
        $data->delete();
        return redirect('/dokter/jadwal')->with('success', 'Schedule deleted successfully');
    }
}
