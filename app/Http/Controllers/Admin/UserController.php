<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // 1. Menampilkan daftar user
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users', compact('users'));
    }

    // 2. Menampilkan form halaman edit
    public function edit(User $user)
    {
        return view('admin.users_edit', compact('user'));
    }

    // 3. Menyimpan perubahan data user
    public function update(Request $request, User $user)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|string|in:admin,premium,free',
        ]);

        // Mapping role ke role_id berdasarkan struktur database Anda
        $roleIdMap = [
            'free' => 1,
            'premium' => 2,
            'admin' => 3,
        ];

        // Update data (menyimpan teks role dan angka role_id sekaligus)
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'role_id' => $roleIdMap[$request->role] ?? 1,
        ]);

        return redirect()->route('admin.users')->with('success', 'Data pengguna berhasil diperbarui!');
    }

    // 4. Menghapus user
    public function destroy(User $user)
    {
        // Mencegah admin menghapus dirinya sendiri secara tidak sengaja
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak bisa menghapus akun Anda sendiri!');
        }

        $user->delete();
        return back()->with('success', 'Pengguna berhasil dihapus!');
    }
}
