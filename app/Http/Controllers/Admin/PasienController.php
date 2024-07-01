<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Search
        $search = $request->search;
        $data = User::with('pasien')->where('role', 'pasien');

        if ($search) {
            $data = $data->where(function ($query) use ($search) {
                $query->where('username', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhereHas('pasien', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%')
                            ->orWhere('birth_date', 'like', '%' . $search . '%')
                            ->orWhere('gender', 'like', '%' . $search . '%')
                            ->orWhere('age', 'like', '%' . $search . '%')
                            ->orWhere('address', 'like', '%' . $search . '%')
                            ->orWhere('phone', 'like', '%' . $search . '%');
                    });
            });
        }

        $data = $data->orderBy('id', 'desc')->paginate(10);

        return view('admin.pasien.index', compact('data'));
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
    public function edit(string $id)
    {
        $data = User::with('pasien')->where('id', $id)->firstOrFail();
        return view('admin.pasien.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = User::with('pasien')->where('id', $id)->firstOrFail();
        // Validasi input
        $request->validate([
            'username' => 'required|unique:users,username,' . $data->id,
            'email' => 'required|email|unique:users,email,' . $data->id,
            'password' => 'nullable|min:8',
            'name' => 'required',
            'birth_date' => 'required',
            'gender' => 'required',
            'age' => 'required|numeric',
            'address' => 'required',
            'phone' => 'required',
        ]);

        $data->update([
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->filled('password') ? Hash::make($request->password) : $data->password,
        ]);

        $data->pasien()->update([
            'name' => $request->name,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'age' => $request->age,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);
        return redirect('admin/pasien')->with('success', 'Patient\'s account successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = User::with('pasien')->where('id', $id)->firstOrFail();
        $data->delete();
        return redirect('admin/pasien')->with('success', 'Patient\'s account successfully deleted');
    }
}
