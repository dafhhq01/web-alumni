<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ManageAdminController extends Controller
{
    /**
     * Menampilkan daftar user yang memiliki role 'admin'.
     */
    public function index()
    {
        // Mengambil user dengan role admin (menggunakan kolom role di tabel users)
        $admins = User::where('role', 'admin')->latest()->get();

        return view('superadmin.manage-admins.index', compact('admins'));
    }

    /**
     * Menampilkan form untuk membuat admin baru.
     */
    public function create()
    {
        return view('superadmin.manage-admins.create');
    }

    /**
     * Menyimpan akun admin baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => ['required', Password::defaults()],
        ]);

        $user = User::create([
            'name'              => $request->name,
            'email'             => $request->email,
            'password'          => Hash::make($request->password),
            'role'              => 'admin', // Otomatis set role sebagai admin
            'email_verified_at' => now(),   // Admin baru langsung diverifikasi
        ]);

        // Assign role via Spatie (karena Anda menggunakan Spatie Permission)
        $user->assignRole('admin');

        return redirect()->route('super-admin.manage-admins.index')
            ->with('success', "Admin {$user->name} berhasil ditambahkan.");
    }

    /**
     * Menampilkan form edit untuk admin tertentu.
     */
    public function edit(string $id)
    {
        // Pastikan hanya user dengan role admin yang bisa diedit di sini
        $admin = User::where('role', 'admin')->findOrFail($id);

        return view('superadmin.manage-admins.edit', compact('admin'));
    }

    /**
     * Memperbarui data admin (Nama, Email, atau Password).
     */
    public function update(Request $request, string $id)
    {
        $admin = User::where('role', 'admin')->findOrFail($id);

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email,' . $admin->id,
            'password' => ['nullable', Password::defaults()], // Password opsional saat update
        ]);

        $admin->name = $request->name;
        $admin->email = $request->email;

        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return redirect()->route('super-admin.manage-admins.index')
            ->with('success', "Data admin {$admin->name} berhasil diperbarui.");
    }

    /**
     * Menghapus akun admin.
     */
    public function destroy(string $id)
    {
        // 1. Cari user yang rolenya admin
        $admin = User::where('role', 'admin')->findOrFail($id);

        $adminName = $admin->name;

        // 2. Hapus role Spatie terlebih dahulu agar tabel model_has_roles bersih
        $admin->roles()->detach();

        // 3. Force Delete (Hapus permanen dari database)
        // Jika model tidak pakai SoftDeletes, forceDelete() akan tetap bekerja seperti delete() biasa
        $admin->forceDelete();

        return redirect()->route('super-admin.manage-admins.index')
            ->with('success', "Akun admin {$adminName} telah dihapus secara permanen dari sistem.");
    }
}
