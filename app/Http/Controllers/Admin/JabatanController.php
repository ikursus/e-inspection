<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class JabatanController extends Controller
{
    /**
     * Display a listing of positions
     */
    public function index()
    {
        $senaraiJabatan = DB::table('jabatan')->get();

        return view('admin.jabatan.template-index', compact('senaraiJabatan'));
    }

    /**
     * Show the form for creating a new position
     */
    public function create()
    {
        return view('admin.jabatan.template-create');
    }

    /**
     * Store a newly created position in storage
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        DB::table('jabatan')->insert($validated);

        return redirect()->route('admin.jabatan.index');
    }

    /**
     * Show the form for editing the specified position
     */
    public function edit($id)
    {
        $jabatan = DB::table('jabatan')->where('id', $id)->first();

        return view('admin.jabatan.template-edit', compact('jabatan'));
    }

    /**
     * Update the specified position in storage
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        DB::table('jabatan')->where('id', $id)->update($validated);

        return redirect()->route('admin.jabatan.index');
    }

    /**
     * Remove the specified position from storage
     */
    public function destroy($id)
    {
        DB::table('jabatan')->where('id', $id)->delete();

        return redirect()->route('admin.jabatan.index');
    }
}
