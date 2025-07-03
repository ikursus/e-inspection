<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InspectionController extends Controller
{
    public function index()
    {
        return view('pengguna.inspections.template-senarai-rekod');
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

        return $data;
        
    }
}