<?php

namespace App\Http\Controllers\Admin;

use App\Models\Jabatan;
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
        // Kaedah Query Builder
        // $senaraiJabatan = DB::table('jabatan')->get();
        // Kaedah Eloquent ORM (Model)
        $senaraiJabatan = Jabatan::all();

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

        // Cara simpan data menggunakan Query Builder
        // DB::table('jabatan')->insert($validated);

        // Cara Simpan data menggunakan Model - Cara 1 - new object
        // $jabatan = new Jabatan();
        // $jabatan->name = $validated['name'];
        // $jabatan->save();

        // Cara Simpan data menggunakan Model - Cara 2 - method create
        $jabatan = Jabatan::create($validated);

        return redirect()->route('admin.jabatan.index');
    }

    /**
     * Show the form for editing the specified position
     */
    public function edit($id)
    {
        // Cara dapatkan data menggunakan Query Builder
        // $jabatan = DB::table('jabatan')->where('id', '=', $id)->first();

        // Cara dapatkan data menggunakan Model method find()
        // $jabatan = Jabatan::find($id);

        // Cara dapatkan data menggunakan Model method where()
        $jabatan = Jabatan::query()->where('id', '=', $id)->first();

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

        // Cara update data menggunakan Query Builder
        // DB::table('jabatan')->where('id', $id)->update($validated);

        // Cara update data menggunakan Model method where()
        // Jabatan::query()->where('id', $id)->update($validated);

        // Cara update data menggunakan Model method find() dan save()
        // $jabatan = Jabatan::find($id);
        // $jabatan->name = $validated['name'];
        // $jabatan->save();

        // Cara update data menggunakan Model method find() dan update()
        $jabatan = Jabatan::find($id);
        $jabatan->update($validated);

        return redirect()->route('admin.jabatan.index');
    }

    /**
     * Remove the specified position from storage
     */
    public function destroy($id)
    {
        // Cara delete data menggunakan Query Builder
        // DB::table('jabatan')->where('id', $id)->delete();

        // Cara delete data menggunakan Model method find() dan delete()
        $jabatan = Jabatan::find($id);
        $jabatan->delete();

        return redirect()->route('admin.jabatan.index');
    }
}
