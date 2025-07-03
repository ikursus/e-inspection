<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of users
     */
    public function index()
    {
        $senaraiUsers = DB::table('users')
            ->leftJoin('jabatan', 'users.jabatan_id', '=', 'jabatan.id')
            ->select('users.*', 'jabatan.name as jabatan_name')
            ->get();

        return view('admin.users.template-index', compact('senaraiUsers'));
    }

    /**
     * Show the form for creating a new user
     */
    public function create()
    {
        $senaraiJabatan = DB::table('jabatan')->get();
        return view('admin.users.template-create', compact('senaraiJabatan'));
    }

    /**
     * Store a newly created user in storage
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:30',
            'jabatan_id' => 'nullable|exists:jabatan,id',
            'password' => 'required|string|min:8|confirmed',
            'status' => 'required|in:active,inactive',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['created_at'] = now();
        $validated['updated_at'] = now();

        DB::table('users')->insert($validated);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified user
     */
    public function edit($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        $senaraiJabatan = DB::table('jabatan')->get();

        return view('admin.users.template-edit', compact('user', 'senaraiJabatan'));
    }

    /**
     * Update the specified user in storage
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phone' => 'nullable|string|max:30',
            'jabatan_id' => 'nullable|exists:jabatan,id',
            'status' => 'required|in:active,inactive',
        ]);

        // Only update password if provided
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'required|string|min:8|confirmed',
            ]);
            $validated['password'] = Hash::make($request->password);
        }

        $validated['updated_at'] = now();

        DB::table('users')->where('id', $id)->update($validated);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diupdate!');
    }

    /**
     * Remove the specified user from storage
     */
    public function destroy($id)
    {
        DB::table('users')->where('id', $id)->delete();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus!');
    }
}