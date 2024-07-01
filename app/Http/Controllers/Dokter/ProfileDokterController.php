<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileDokterController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $user_id = $user->id;
        $data = User::with('dokter')->where('id', $user_id)->firstOrFail();

        return view('dokter.profile.index', compact('data'));
    }

    public function update(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::with('dokter')->where('id', $id)->firstOrFail();

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

        return redirect('dokter/profile')->with('success', 'Profile updated successfully.');
    }
}
