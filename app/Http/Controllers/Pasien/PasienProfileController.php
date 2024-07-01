<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Pasien;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasienProfileController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        if (!$user->pasien) {
            return view('pasien.profile');
        } else {
            $user_id = $user->id;
            $data = User::with('pasien')->where('id', $user_id)->firstOrFail();
            return view('pasien.profile', compact('data'));
        }
    }


    public function create(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required',
            'birth_date' => 'required',
            'gender' => 'required',
            'age' => 'required|numeric',
            'address' => 'required',
            'phone' => 'required',
        ]);

        Pasien::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'age' => $request->age,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);

        return redirect()->route('pasien.profile')->with('success', 'Profil berhasil ditambahkan.');
    }

    public function update(Request $request, string $id)
    {
        $data = User::with('pasien')->where('id', $id)->firstOrFail();

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

        return redirect()->route('pasien.profile')->with('success', 'Profil berhasil diperbarui.');
    }
}
