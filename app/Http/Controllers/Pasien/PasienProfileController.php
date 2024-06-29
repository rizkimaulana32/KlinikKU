<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Pasien;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PasienProfileController extends Controller
{
    
    public function index()
    {
        $user = Auth::user();
        $profile = $user->profilePasien;
        if (!$user->pasien){
            return view('pasien.profile', compact('profile'));
        } else {
            $dataPasien = Pasien::where('id', $user->pasien->id )->first();
            return view('pasien.profile', compact('dataPasien','profile'));
        }
        
    }

    
    public function create(ProfileUpdateRequest $request)
    {
        $user = Auth::user();

        $profile = $user->profilePasien ?? new Pasien();

        $profile->user_id = $user->id;
        $profile->name = $request->name;
        $profile->birth_date = $request->birth_date;
        $profile->age = $request->age;
        $profile->gender = $request->gender;
        $profile->address = $request->address;
        $profile->phone = $request->phone;

        $profile->save();

        return redirect()->route('pasien.profile')->with('success', 'Profil berhasil diperbarui.');
                                                    
    }

    public function update(Request $request, string $id)
    {
        $dataPasien = Pasien::where('id', $id )->first();

        $dataPasien->update([
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
