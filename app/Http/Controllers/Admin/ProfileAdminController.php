<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileAdminController extends Controller
{
    public function index()
    {
        $data = Auth::user();
        return view('admin.profile.index', compact('data'));
    }

    public function update(Request $request)
    {
        $admin_id = Auth::user()->id;
        $data = User::where('id', $admin_id)->firstOrFail();

        $request->validate([
            'username' => 'required|unique:users,username,' . $data->id,
            'email' => 'required|email|unique:users,email,' . $data->id,
            'password' => 'nullable|min:8',
        ]);

        $data->update([
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->filled('password') ? Hash::make($request->password) : $data->password,
        ]);

        return redirect('/admin/profile')->with('success', 'Profile updated successfully');
    }
}
