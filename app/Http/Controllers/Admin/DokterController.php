<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $data = User::with('dokter')->where('role', 'dokter');
        if ($search) {
            $data = $data->where(function ($query) use ($search) {
                $query->where('username', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhereHas('dokter', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%')
                            ->orWhere('spesialis', 'like', '%' . $search . '%')
                            ->orWhere('gender', 'like', '%' . $search . '%')
                            ->orWhere('age', 'like', '%' . $search . '%')
                            ->orWhere('phone', 'like', '%' . $search . '%');
                    });
            });
        }

        $data = $data->orderBy('id', 'desc')->paginate(10);

        return view('admin.dokter.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dokter.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'name' => 'required',
            'spesialis' => 'required',
            'gender' => 'required',
            'age' => 'required|numeric',
            'phone' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Simpan user baru
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'dokter',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/dokterImg', $imageName);
            $imagePath = 'storage/dokterImg/' . $imageName;
        } else {
            $imagePath = null;
        }

        // Simpan dokter yang terkait
        Dokter::create([
            'user_id' => $user->id, // Menggunakan id dari user yang baru dibuat
            'name' => $request->name,
            'spesialis' => $request->spesialis,
            'gender' => $request->gender,
            'age' => $request->age,
            'phone' => $request->phone,
            'image' => $imagePath,
        ]);

        return redirect('admin/dokter')->with('success', 'Doctor\'s account auccessfully created');
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
        $data = User::with('dokter')->where('id', $id)->firstOrFail();
        return view('admin.dokter.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = User::with('dokter')->where('id', $id)->firstOrFail();
        // Validasi input
        $request->validate([
            'username' => 'required|unique:users,username,' . $data->id,
            'email' => 'required|email|unique:users,email,' . $data->id,
            'password' => 'nullable|min:8',
            'name' => 'required',
            'spesialis' => 'required',
            'gender' => 'required',
            'age' => 'required|numeric',
            'phone' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data->update([
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->filled('password') ? Hash::make($request->password) : $data->password,
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/dokterImg', $imageName);
            $imagePath = 'storage/dokterImg/' . $imageName;
        } else {
            $imagePath = $data->dokter->image;
        }

        $data->dokter()->update([
            'name' => $request->name,
            'spesialis' => $request->spesialis,
            'gender' => $request->gender,
            'age' => $request->age,
            'phone' => $request->phone,
            'image' => $imagePath,
        ]);
        return redirect('admin/dokter')->with('success', 'Doctor\'s account successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = User::with('dokter')->where('id', $id)->firstOrFail();
        // Hapus gambar jika ada
        // if ($data->dokter->image) {
        //     Storage::delete($data->dokter->image);
        //     unlink(public_path($data->dokter->image));
        // }

        if ($data->dokter->image) {
            $imagePath = $data->dokter->image;

            // Cek apakah gambar merupakan path lokal
            if (!filter_var($imagePath, FILTER_VALIDATE_URL)) {
                // Hapus gambar dari storage jika itu adalah path lokal
                Storage::delete($imagePath);
                unlink(public_path($imagePath));
            }
        }

        $data->delete();
        return redirect('admin/dokter')->with('success', 'Doctor\'s account successfully deleted');
    }


    public function list(Request $request)
    {
        $data = Dokter::query();
        $search = $request->search;
        if ($search) {
            $data = $data->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('spesialis', 'like', '%' . $search . '%');
            });
        }

        $data = $data->orderBy('id', 'desc')->paginate(10);
        return view('admin.list.index', compact('data'));
    }
}
