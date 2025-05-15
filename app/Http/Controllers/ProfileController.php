<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Menampilkan profil user dalam mode VIEW
     */
    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    /**
     * Menampilkan form edit profil
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Memproses update profil
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        ]);

        $data = $request->only(['name', 'email']);

        // Handle upload foto
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($user->photo && Storage::exists('public/'.$user->photo)) {
                Storage::delete('public/'.$user->photo);
            }

            // Simpan foto baru
            $path = $request->file('photo')->store('public/'.$user->id);
            $data['photo'] = str_replace('public/', '', $path);
        }

        // Update data user
        $user->update($data);

        return redirect()->route('profile.show')
                         ->with('success', 'Profil berhasil diperbarui!');
    }
}
