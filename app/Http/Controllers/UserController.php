<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $users = User::withTrashed()->latest()->get();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
           $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->except('photo');
        $data['password'] = bcrypt($request->password);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('public/users');
            $data['photo'] = str_replace('public/', '', $path);
        }

        User::create($data);

        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
       return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->except('photo');

        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($user->photo) {
                Storage::delete('public/' . $user->photo);
            }

            $path = $request->file('photo')->store('public/users');
            $data['photo'] = str_replace('public/', '', $path);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
         $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
     public function restore($id)
    {
        User::withTrashed()->find($id)->restore();
        return back()->with('success', 'User restored successfully');
    }
    public function forceDelete($id)
    {
        $user = User::withTrashed()->find($id);

        // Hapus foto jika ada
        if ($user->photo) {
            Storage::delete('public/' . $user->photo);
        }

        $user->forceDelete();
        return back()->with('success', 'User permanently deleted');
    }
}
