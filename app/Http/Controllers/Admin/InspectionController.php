<?php

namespace App\Http\Controllers\Admin;

use App\Models\Inspection;
use Illuminate\Http\Request;
use PDF;
use App\Exports\InspectionExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class InspectionController extends Controller
{
    public function index()
    {
        $inspections = Inspection::with(['user'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.inspections.template-index', [
            'inspections' => $inspections
        ]);
    }

    public function show($id)
    {
        $inspection = Inspection::with(['user', 'attachments'])->findOrFail($id);
        
        return view('admin.inspections.template-show', [
            'inspection' => $inspection
        ]);
    }

    public function destroy($id)
    {
        try {
            $inspection = Inspection::findOrFail($id);
            
            // Hapus semua attachments terkait
            $inspection->attachments()->delete();
            
            // Hapus inspection
            $inspection->delete();
            
            return redirect()->route('admin.inspections.index')
                ->with('success', 'Inspeksi berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.inspections.index')
                ->with('error', 'Gagal menghapus inspeksi: ' . $e->getMessage());
        }
    }

    public function export()
    {
        return Excel::download(new InspectionExport, 'inspections.xlsx');
    }

    public function pdf()
    {
        $senaraiInspections = Inspection::with(['user', 'attachments'])->get();

        $pdf = PDF::loadView('admin.inspections.template-pdf', compact('senaraiInspections'));

        return $pdf->stream(date('YmdHis') . '-inspections-report.pdf');
    }
}
