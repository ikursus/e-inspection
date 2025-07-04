<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Inspection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class InspectionController extends Controller
{
    public function index(Request $request)
    {
        // $senaraiInspection = Inspection::orderBy('id', 'desc')->get();
        // $senaraiInspection = Inspection::latest()->get();
        $senaraiInspection = Inspection::latest()->paginate($request->input('bilangan') ?? 5);


        // Cara 1 attach data ke template menggunakan kaedah method ->with()
        // return view('pengguna.inspections.template-senarai-rekod')->with('senaraiInspection', $senaraiInspection);

        // Cara 2 attach data ke template menggunakan kaedah array
        return view('pengguna.inspections.template-senarai-rekod', ['senaraiInspection' => $senaraiInspection]);

        // Cara 3 attach data ke template
        return view('pengguna.inspections.template-senarai-rekod', compact('senaraiInspection'));
    }

    public function create()
    {
        return view('pengguna.inspections.template-tambah-rekod');
    }

    public function store(Request $request)
    {
        // Validate the request
        $data = $request->validate([
            'tarikh' => ['required', 'date'],
            'masa' => ['required', 'date_format:H:i'],
            'tempat' => ['required'],
            'tempat_sub' => ['required'],
            'remarks' => ['required'],
            'attachments.*' => ['nullable', 'file', 'mimes:pdf,doc,docx,jpg,jpeg,png', 'max:2048']
        ]);

        // Simpan rekod inspection menggunakan model Inspection
        $data['user_id'] = 3;
        $inspection = Inspection::create($data);

        // Cara untuk simpan data attachment ke table attachments
        if ($request->hasFile('attachments')) {

            foreach ($request->file('attachments') as $file) {

                $filename = $file->getClientOriginalName();
                $file->storeAs('attachments', $filename, 'public');

                // $inspection->attachments()->create([
                //     'filename' => $filename,
                //     'path' => 'attachments/' . $filename,
                // ]);
                // Kaedah 1 simpan attachment yang ada relation dengan inspection
                Attachment::create([
                    'inspection_id' => $inspection->id,
                    'file' => $filename,
                ]);
            }

        }


        return redirect()->route('user.inspections.rekod');        
    }

    public function show($id)
    {
        // $inspection = Inspection::find($id);
        // Dapatkan data inspection dan attachment menerusi query builder join table
        
        // $inspection = DB::table('inspections')
        //     ->where('id','=', $id)
        //     ->first();

        // $attachments = DB::table('attachments')
        //     ->where('inspection_id', $id)
        //     ->get();

        $inspection = Inspection::with('attachments')->find($id);
        
        $attachments = $inspection->attachments;

        // Return view with inspection details
        return view('pengguna.inspections.template-show-rekod', compact('inspection', 'attachments'));
    }
}